<?php

namespace XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class QuantumTaxDetail extends Controller
{
    const TABLENAME = "xe_quantum_taxbill_trans";

    public function view(Request $request)
    {
        $tid = $request->tid; // 세금계산서 거래내역 id
        if($tid) {
            $row = DB::table('xe_quantum_taxbill_trans')->where('id', $tid)->first();
            if($row) {
                // 상세 거래상품 정보
                $products = DB::table('xe_quantum_taxbill_detail')->where('trans_id', $row->id)->get();
                // 담당자 정보
                $contact = DB::table('xe_quantum_taxbill_contact')->where('trans_id', $row->id)->get();

                return view("tax::tax.view",[
                    'info'=>$row,
                    'products'=>$products,
                    'contact'=>$contact
                ]);
            }

            return "선택한 tid의 내역이 존재하지 않습니다.";
        }

        return "거래내역 tid가 선택되지 않았습니다.";
    }

    public function update(Request $request)
    {
        $tid = $request->id; // 세금계산서 거래내역 id
        if($tid) {
            $data = [];
            foreach($request->all() as $key=>$value) {
                if(is_array($value)) continue;
                if($key[0] == "_") continue;

                $data[$key] = $value;
            }
            unset($data['invoicer_mgt_key']); // 문서번호는 수정하지 않음
            DB::table('xe_quantum_taxbill_trans')->where('id',$tid)->update($data); // 갱신

            // 거래목록 수정
            // step1: 컬럼필드별 데이터 어레이 정렬처리
            foreach($request->products as $key => $item) {
                foreach($item as $i => $value) {
                    $products[$i][$key] = $value;
                    $products[$i]['serial_num'] = $i+1;
                    $products[$i]['trans_id'] = $tid;
                }
            }

            // step2: 날짜형식 변환 및 필드처리
            foreach($products as $i => $item) {
                $purchase_dt = date("Y").sprintf("%02d",$item['purchase_month']).sprintf("%02d",$item['purchase_day']);
                $products[$i]['purchase_dt'] = $purchase_dt;

                unset($products[$i]['purchase_month']);
                unset($products[$i]['purchase_day']);
            }

            // 새로 추가된것과 업데이트 할것을 구분하여 처리
            foreach($products as $item){

                if($item['id']) {
                    //$_update []= $item; // 수정해야 되는 항목
                    DB::table('xe_quantum_taxbill_detail')->where('id',$item['id'])->update($item);
                } else {
                    //$_insert []= $item;
                    DB::table('xe_quantum_taxbill_detail')->insert($item);
                }
            }




            // 담당자 수정
            // ==>작업해야함

            return redirect()->back();
        }
        return "거래내역 tid가 선택되지 않았습니다.";
    }










    public function detail(Request $request)
    {
        $row = DB::table('xe_quantum_taxbill_trans')->where('invoicer_mgt_key', $request->doc)->first();
        //dd($row);
        //dd($row->id);
        $products = DB::table('xe_quantum_taxbill_detail')->where('trans_id', $row->id)->get();
        //dd($products);
        $contact = DB::table('xe_quantum_taxbill_contact')->where('trans_id', $row->id)->get();
        return view("tax::tax.detail",['info'=>$row, 'products'=>$products, 'contact'=>$contact]);

    }

    public function edit(Request $request)
    {
        $data = $request->all();

        // 세금계산서 발행정보 DB저장
        $info = [];
        foreach($data as $key => $item) {
            if(is_array($item)) continue;
            if($key == "_token") continue;

            $info[$key] = $item;
        }
        //dd($info);
        $info['updated_at'] = $info['created_at'] = date("Y-m-d H:i:s");
        $id = DB::table(self::TABLENAME)->insertGetId($info);
        // $id = 0;


        // 상품목록 처리 step1
        $products = [];
        foreach($data['products'] as $key => $arr) {
            foreach($arr as $i => $value) {
                $products[$i][$key] = $value;
                $products[$i]['serial_num'] = $i+1;
                $products[$i]['trans_id'] = $id;
            }
        }

        // 상품목록 처리 step2
        foreach($products as $i => $item) {
            $purchase_dt = date("Y").sprintf("%02d",$item['purchase_month']).sprintf("%02d",$item['purchase_day']);
            $products[$i]['purchase_dt'] = $purchase_dt;

            unset($products[$i]['purchase_month']);
            unset($products[$i]['purchase_day']);
        }



        DB::table('xe_quantum_taxbill_detail')->insert($products);

        //dd($products);


        //$row = toInsertDBObject(self::TABLENAME, $this->Taxinvoice);


        return redirect()->back();
    }



}
