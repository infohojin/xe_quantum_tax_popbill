<?php

namespace XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Linkhub\LinkhubException;
use Linkhub\Popbill\JoinForm;
use Linkhub\Popbill\CorpInfo;
use Linkhub\Popbill\ContactInfo;
use Linkhub\Popbill\ChargeInfo;
use Linkhub\Popbill\PopbillException;
use Linkhub\Popbill\PopbillTaxinvoice;
use Linkhub\Popbill\TIENumMgtKeyType;
use Linkhub\Popbill\Taxinvoice;
use Linkhub\Popbill\TaxinvoiceDetail;
use Linkhub\Popbill\TaxinvoiceAddContact;

use Illuminate\Support\Facades\DB;
use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\Trans\InvoiceBuilder;

class QuantumShopTax extends Controller
{
    const TABLENAME = "xe_quantum_taxbill_trans";

    /**
     * 샵목록을 출력하고, 연동회원 가입과 인증서를 관리 합니다.
     */
    public function shop()
    {
        // 샵 목록
        $rows = DB::table('xe_quantum_shop')->get();
        if($rows) {
            // 팝빌 연동정보 데이터 결합
            // ids 데이터 추출
            $ids = [];
            foreach($rows as $item) {
                $ids []= $item->shop_id;
            }
            $temp = DB::table('xe_quantum_tax_popbill')->whereIn('shop_id',$ids)->get();

            // 검색정렬 by key
            $taxInfo =[];
            foreach($temp as $item) {
                $key = $item->shop_id;
                $taxInfo[$key] = $item;
            }

            // 데이터결합
            foreach($rows as $i=>$row) {
                $key = $row->shop_id;
                if(isset($taxInfo[$key])) {
                    $rows[$i]->popbill = $taxInfo[$key];
                }
            }

            unset($ids); unset($temp); // 메모리제거
        }

        return view("tax::shop.index",['shop'=>$rows]);
    }



    /**
     * 선택된 샵의
     * 발행된 세금목록을 출력합니다.
     */
    public function shoptax(Request $request)
    {
        $shop_id = $request->uuid;
        if($shop_id) {
            $shop = DB::table('xe_quantum_shop')->where('shop_id', $request->uuid)->first();

            $rows = DB::table('xe_quantum_taxbill_trans')
                ->where('invoicer_corp_num', $shop->business_id)->get();
            return view("tax::shop.tax.index",['rows'=>$rows, 'shop'=>$shop]);
        }

        return "선택된 샵이 없습니다.";
    }


    /**
     * 세금계산서 신규발행 정보를 기록합니다.
     */
    public function create(Request $request)
    {
        $shop_id = $request->uuid;
        $invoice = new InvoiceBuilder();

        // 공급자정보
        $shop = DB::table('xe_quantum_shop')->where('shop_id', $shop_id)->first();
        if($shop) {
            $invoice->setShopInfo($shop);
        }

        // 공급받는자
        $invoice->setInvoiceeType("사업자")->setDesignerInfo([]);

        // 공급상품

        // 합계 및 정보

        return view('tax::shop.tax.create',[
            'shop_id'=>$shop_id,
            'info'=>$invoice,
            'products'=>[],
            'contact'=>[]
        ]);
    }

    /**
     * 자체DB에 세금계산서 정보를 기록합니다.
     */
    public function store(Request $request)
    {
        $shop_id = $request->uuid;



        // 입력폼 정리
        $data = [];
        foreach($request->all() as $key => $value) {
            if($key[0] == "_") continue;
            if(is_array($value)) continue;

            $data[$key] = $value;
        }
        $data['updated_at']=$data['created_at']=date("Y-m-d H:i:s");

        // 발행타입 상수값 설정
        $data['issue_type'] = "정발행";
        $data['charge_direction'] = "정과금";

        $id = DB::table(self::TABLENAME)->insertGetId($data);
        $data['id']=$id;

        // 상품목록 처리
        // step1: 컬럼필드별 데이터 어레이 정렬처리
        $products = [];
        foreach($request->products as $key => $arr) {
            foreach($arr as $i => $value) {
                $products[$i][$key] = $value;
                $products[$i]['serial_num'] = $i+1;
                $products[$i]['trans_id'] = $id;
            }
        }

        // step2: 날짜형식 변환 및 필드처리
        foreach($products as $i => $item) {
            $purchase_dt = date("Y").sprintf("%02d",$item['purchase_month']).sprintf("%02d",$item['purchase_day']);
            $products[$i]['purchase_dt'] = $purchase_dt;

            unset($products[$i]['purchase_month']);
            unset($products[$i]['purchase_day']);

            unset($products[$i]['id']);
        }

        DB::table('xe_quantum_taxbill_detail')->insert($products);


        return redirect()->back();
    }


    /**
     * 임시등록
     * 기록된 거래정보를 세금계산서 발행을 위하여 팝빌에 임시등록을 처리합니다.
     */
    public function regist(Request $request)
    {
        $shop_id = $request->uuid;
        $popbill = DB::table('xe_quantum_tax_popbill')->where('shop_id', $shop_id)->first();
        if( $popbill && $popbill->popbill_id) {
            // 1. DB에 저장된 거래내역 읽기
            $tid = $request->tid;
            $trans = DB::table('xe_quantum_taxbill_trans')->where('id', $tid)->first();
            if($trans) {
                // 2. API 호출
                $obj = new \XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\Trans\Regist();
                $result = $obj->tempRegist($trans, $popbill->popbill_id);
                //dd($result);
            }

            return redirect()->back();
        }

        return "연동회원이 신청되어 있지 않습니다.";
    }

    /**
     * "임시저장" 또는 "(역)발행대기" 상태의 세금계산서를 발행(전자서명)하며, "발행완료" 상태로 처리합니다.
     * - 세금계산서 국세청 전송정책 [https://docs.popbill.com/taxinvoice/ntsSendPolicy?lang=laravel]
     * - "발행완료" 된 전자세금계산서는 국세청 전송 이전에 발행취소(CancelIssue API) 함수로 국세청 신고 대상에서 제외할 수 있습니다.
     * - 세금계산서 발행을 위해서 공급자의 인증서가 팝빌 인증서버에 사전등록 되어야 합니다.
     *   └ 위수탁발행의 경우, 수탁자의 인증서 등록이 필요합니다.
     * - 세금계산서 발행 시 공급받는자에게 발행 메일이 발송됩니다.
     * - https://docs.popbill.com/taxinvoice/phplaravel/api#TIIssue
     */
    public function issue(Request $request)
    {
        $shop_id = $request->uuid;
        $popbill = DB::table('xe_quantum_tax_popbill')->where('shop_id', $shop_id)->first();
        if( $popbill && $popbill->popbill_id) {
            // 1. DB에 저장된 거래내역 읽기
            $tid = $request->tid;
            $trans = DB::table('xe_quantum_taxbill_trans')->where('id', $tid)->first();
            if($trans && !$trans->nts_confirm_num) {
                // 2. API 호출
                $obj = new \XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\Trans\Regist();
                $result = $obj->issue($trans, $popbill->popbill_id);
            }

            return redirect()->back();

        }

        return "연동회원이 신청되어 있지 않습니다.";


    }




}
