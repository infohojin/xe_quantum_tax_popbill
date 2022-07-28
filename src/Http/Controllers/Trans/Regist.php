<?php

namespace XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\Trans;

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

class Regist extends \XEHub\XePlugin\CustomQuantum\Tax\Http\Popbill
{
    /**
     * 문서번호 중복 사용여부 체크
     */
    private function checkMgtKeyInUse()
    {
        $mgtKeyType = TIENumMgtKeyType::SELL;
        try {
            $result = $this->PopbillTaxinvoice->CheckMgtKeyInUse($this->getCorpNum(), $mgtKeyType,  $this->getInvoicerMgtKey() );
            return $result;
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
            //dd(['code' => $code, 'message' => $message]);
            return ['code' => $code, 'message' => $message];
        }
    }

    private function genRandomText($max)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $var_size = strlen($chars);

        $gen = "";
        for( $x = 0; $x < $max; $x++ ) {
            $gen .= $chars[ rand( 0, $var_size - 1 ) ];
        }

        return $gen;
    }

    // 자료를 팝빌로 임시등록을 처리합니다.
    public function tempRegist($trans, $popbill_id)
    {
        $this->setUserID($popbill_id); // 팝빌 가입 아이디
        $this->setCorpNum($trans->invoicer_corp_num); // 사업자번호

        // 문서번호를 생성
        $invoicerMgtKey = $this->invoiceMgtKeyGen(date("Ymd").'-'.$this->genRandomText(5));
        $this->setInvoicerMgtKey($invoicerMgtKey);
        //dump($invoicerMgtKey);

        $checkResultMgtKey = $this->checkMgtKeyInUse();
        //dd($checkResultMgtKey);
        if(!$checkResultMgtKey) {

            // 1.세금계산서 발행 정보
            $this->setWriteDate()->setIssueType("정발행");
            $this->setChargeDirection("정과금")->setPurposeType("영수")->setTaxType('과세');


            // 2. 공급자 정보를 설정합니다.
            $this->setSeller([
                'invoicerCorpNum' => $trans->invoicer_corp_num, // 공급자 사업자번호

                'invoicerTaxRegID' => $trans->invoicer_tax_reg_id, // 공급자 종사업장 식별번호, 4자리 숫자 문자열
                'invoicerCorpName' => $trans->invoicer_corp_name, // 공급자 상호
                // 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
                'invoicerMgtKey' => $this->getInvoicerMgtKey(), // 공급자 문서번호
                'invoicerCEOName' => $trans->invoicer_ceo_name, // 공급자 대표자성명
                'invoicerAddr' => $trans->invoicer_addr, // 공급자 주소
                'invoicerBizClass' => $trans->invoicer_biz_class, // 공급자 종목
                'invoicerBizType' => $trans->invoicer_biz_type, // 공급자 업태
                'invoicerContactName' => $trans->invoicer_contact_name, // 공급자 담당자 성명
                'invoicerEmail' => $trans->invoicer_email, // 공급자 담당자 메일주소
                'invoicerTEL' => $trans->invoicer_tel, // 공급자 담당자 연락처
                'invoicerHP' => $trans->invoicer_hp // 공급자 휴대폰 번호
            ])->setInvoicerSMSSendYN($status=false);


            // 3. 공급받는자 정보
            $this->setBuyer([
                'invoiceeType' => $trans->invoicee_type, // 공급받는자 구분, [사업자, 개인, 외국인] 중 기재

                // - {invoiceeType}이 "사업자" 인 경우, 사업자번호 (하이픈 ('-') 제외 10자리)
                // - {invoiceeType}이 "개인" 인 경우, 주민등록번호 (하이픈 ('-') 제외 13자리)
                // - {invoiceeType}이 "외국인" 인 경우, "9999999999999" (하이픈 ('-') 제외 13자리)
                'invoiceeCorpNum' => $trans->invoicee_corp_num, // 공급받는자 사업자번호

                'invoiceeTaxRegID' => $trans->invoicee_tax_reg_id, // 공급받는자 종사업장 식별번호, 4자리 숫자 문자열
                'invoiceeCorpName' => $trans->invoicee_corp_name, // 공급받는자 상호
                'invoiceeMgtKey' => $trans->invoicee_mgt_key, // [역발행시 필수] 공급받는자 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성

                'invoiceeCEOName' => $trans->invoicee_ceo_name, // 공급받는자 대표자성명
                'invoiceeAddr' => $trans->invoicee_addr, // 공급받는자 주소
                'invoiceeBizType' => $trans->invoicee_biz_type, // 공급받는자 업태
                'invoiceeBizClass' => $trans->invoicee_biz_class, // 공급받는자 종목
                'invoiceeContactName1' => $trans->invoicee_contact_name1, // 공급받는자 담당자 성명


                // 팝빌 개발환경에서 테스트하는 경우에도 안내 메일이 전송되므로,
                // 실제 거래처의 메일주소가 기재되지 않도록 주의
                'invoiceeEmail1' => $trans->invoicee_email1, // 공급받는자 담당자 메일주소
                'invoiceeTEL1' => $trans->invoicee_tel1, // 공급받는자 담당자 연락처
                'invoiceeHP1' => $trans->invoicee_hp1 // 공급받는자 담당자 휴대폰 번호

            ])->setInvoiceeSMSSendYN($status=false);



            $this->setTrans([
                'supplyCostTotal' => $trans->supply_cost_total, // 공급가액 합계
                'taxTotal' => $trans->tax_total, // 세액 합계
                'totalAmount' => $trans->total_amount, // 합계금액, (공급가액 합계 + 세액 합계)
                'serialNum' => $trans->serial_num, // 기재상 '일련번호'항목
                'cash' => $trans->cash, // 기재상 '현금'항목
                'chkBill' => $trans->chk_bill, // 기재상 '수표'항목
                'note' => $trans->note, // 기재상 '어음'항목
                'credit' => $trans->credit, // 기재상 '외상'항목

                'remark1' => $trans->remark1, // 비고
                'remark2' => $trans->remark2, // {invoiceeType}이 "외국인" 이면 remark1 필수
                'remark3' => $trans->remark3, // - 외국인 등록번호 또는 여권번호 입력

                'kwon' => $trans->kwon, // 기재상 '권' 항목, 최대값 32767
                'ho' => $trans->ho, // 기재상 '호' 항목, 최대값 32767

                // 사업자등록증 이미지 첨부여부 (true / false 중 택 1)
                // └ true = 첨부 , false = 미첨부(기본값)
                // - 팝빌 사이트 또는 인감 및 첨부문서 등록 팝업 URL (GetSealURL API) 함수를 이용하여 등록
                'businessLicenseYN' => false,

                // 통장사본 이미지 첨부여부 (true / false 중 택 1)
                // └ true = 첨부 , false = 미첨부(기본값)
                // - 팝빌 사이트 또는 인감 및 첨부문서 등록 팝업 URL (GetSealURL API) 함수를 이용하여 등록
                'bankBookYN' => false

                /************************************************************
                 *                     수정 세금계산서 기재정보
                 * - 수정세금계산서 관련 정보는 연동매뉴얼 또는 개발가이드 링크 참조
                 * - [참고] 수정세금계산서 작성방법 안내 - https://docs.popbill.com/taxinvoice/modify?lang=phplaravel
                 ************************************************************/

                // [수정세금계산서 작성시 필수] 수정사유코드, 수정사유에 따라 1~6중 선택기재
                // 'modifyCode' => '',

                // [수정세금계산서 작성시 필수] 원본세금계산서 국세청 승인번호 기재
                // 'orgNTSConfirmNum' => ''
            ]);


            // 상세 상품정보 설정
            $products = DB::table('xe_quantum_taxbill_detail')->where('trans_id', $trans->id)->get();
            $temp = [];
            foreach($products as $i=>$item) {
                $temp []= [
                    'serialNum' => $i+1,               // [상세항목 배열이 있는 경우 필수] 일련번호 1~99까지 순차기재,
                    'purchaseDT' => $item->purchase_dt,     // 거래일자
                    'itemName' => $item->item_name,      // 품명
                    'spec' => $item->spec,                   // 규격
                    'qty' => $item->qty,                    // 수량
                    'unitCost' => $item->unit_cost,               // 단가
                    'supplyCost' => $item->supply_cost,       // 공급가액
                    'tax' => $item->tax,               // 세액
                    'remark' => $item->remark                 // 비고
                ];
            }
            $this->setProduct($temp);

            // 담당자 정보
            $contacts = DB::table('xe_quantum_taxbill_contact')->where('trans_id', $trans->id)->get();
            $temp = [];
            foreach($contacts as $i=>$item) {
                $temp []= [
                    'serialNum'=>$i+1,
                    'contactName'=>$item->contact_name,
                    'email'=>$item->email
                ];
            }
            $this->setContact($temp);

            //dd($this->Taxinvoice);

            // 기타설정
            $this->writeSpecification(); // 거래명세서 동시작성여부
            try {
                $result = $this->PopbillTaxinvoice->Register(
                    $this->testCorpNum, // 팝빌 가입회원 사업자번호
                    $this->Taxinvoice,
                    $this->testUserID, // 팝빌 회원 아이디
                    $this->writeSpecification
                );
                $code = $result->code;
                $message = $result->message;

                // 성공한경우 문서번호 갱신
                DB::table('xe_quantum_taxbill_trans')
                    ->where('id', $trans->id)
                    ->update(['invoicer_mgt_key'=> $this->invoicerMgtKey]);

            }
            catch(PopbillException $pe) {
                $code = $pe->getCode();
                $message = $pe->getMessage();
            }

            return [
                'code'=>$code,
                'message'=>$message
            ];
        }

        return $checkResultMgtKey;

    }


    public function thirdTempRegist($trans)
    {
        $this->Taxinvoice->trusteeCorpNum = "8588101858";
        $this->Taxinvoice->trusteeMgtKey = "20220726-abcd-001";
        //$this->Taxinvoice->trusteeTaxRegID = "";
        $this->Taxinvoice->trusteeCorpName = "퀀텀리프";
        $this->Taxinvoice->trusteeCEOName = "권바울";
        //$this->Taxinvoice->trusteeAddr = "";
        //$this->Taxinvoice->trusteeBizClass = "";
        //$this->Taxinvoice->trusteeBizType = "";
        //$this->Taxinvoice->trusteeContactName = "";
        //$this->Taxinvoice->trusteeDeptName = "";
        //$this->Taxinvoice->trusteeTEL = "";
        //$this->Taxinvoice->trusteeHP = "";
        //$this->Taxinvoice->trusteeEmail = "";
        //$this->Taxinvoice->trusteeSMSSendYN = "";
    }

    public function issue($trans, $popbill_id)
    {
        // 팝빌 회원 사업자번호, '-' 제외 10자리
        $testCorpNum = $trans->invoicer_corp_num;

        // 발행유형, SELL:매출, BUY:매입, TRUSTEE:위수탁
        $mgtKeyType = TIENumMgtKeyType::SELL;

        // 문서번호
        $mgtKey = $trans->invoicer_mgt_key;

        // 메모
        $memo = '발행 메모입니다';

        // 발행 안내메일 제목, 미기재시 기본제목으로 전송
        $EmailSubject = null;

        // 지연발행 강제여부  (true / false 중 택 1)
        // └ true = 가능 , false = 불가능
        // - 미입력 시 기본값 false 처리
        // - 발행마감일이 지난 세금계산서를 발행하는 경우, 가산세가 부과될 수 있습니다.
        // - 가산세가 부과되더라도 발행을 해야하는 경우에는 forceIssue의 값을
        //   true로 선언하여 발행(Issue API)를 호출하시면 됩니다.
        $forceIssue = false;

        // 팝빌회원 아이디
        //$testUserID = $popbill->popbill_id;

        try {
            $result = $this->PopbillTaxinvoice->Issue($testCorpNum, $mgtKeyType, $mgtKey, $memo, $EmailSubject, $forceIssue, $popbill_id);
            $code = $result->code;
            $message = $result->message;
            $ntsConfirmNum = $result->ntsConfirmNum;

            // 성공한경우 문서번호 갱신
            DB::table('xe_quantum_taxbill_trans')
            ->where('id', $trans->id)
            ->update(['nts_confirm_num'=> $result->ntsConfirmNum]);
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
            $ntsConfirmNum = null;
        }

        return ['code' => $code, 'message' => $message, 'ntsConfirmNum' => $ntsConfirmNum];
    }




}
