<?php

namespace XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class QuantumTaxDetail extends Controller
{
    const TABLENAME = "xe_quantum_taxbill_trans";

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
