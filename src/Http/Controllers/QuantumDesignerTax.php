<?php

namespace XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class QuantumDesignerTax extends Controller
{
    public function designers()
    {
        $rows = DB::table('xe_quantum_designer')->get();
        if($rows) {
            // 디자이너 비지니스 정보 결합
            $ids=[];
            foreach($rows as $row) {
                $ids []= $row->user_id;
            }
            $temp = DB::table('xe_quantum_designer_business_license')->whereIn('user_id',$ids)->get();

            // Key Sort
            $business = [];
            foreach($temp as $item) {
                $key = $item->user_id;
                $business[$key] = $item;
            }



            // 결합
            foreach($rows as $i=>$item) {
                $user_id = $item->user_id;
                if(isset($business[$user_id])) {
                    $rows[$i]->business = $business[$user_id];
                }
            }

            //dd($rows);
        }
        return view("tax::designer.all",['designer'=>$rows]);
    }

    public function deginertax(Request $request)
    {

        $designer = DB::table('xe_quantum_designer_business_license')->where('user_id', $request->uuid)->first();
        if($designer) {
            $rows = DB::table('xe_quantum_taxbill_trans')->where('invoicer_corp_num', $designer->business_id)->get();
            return view("tax::designer.tax",['trans'=>$rows]);
        }

        return "미등록 사업자 디자이너 입니다.";
    }




}
