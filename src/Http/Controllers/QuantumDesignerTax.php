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
        return view("tax::designer.all",['designer'=>$rows]);
    }

    public function deginertax(Request $request)
    {

        $designer = DB::table('xe_quantum_designer_business_license')->where('user_id', $request->uuid)->first();
        if($designer) {
            $rows = DB::table('xe_quantum_taxbill_trans')->where('invoicer_corp_num', $designer->business_id)->get();
            return view("tax::tax.designer",['trans'=>$rows]);
        }

        return "미등록 사업자 디자이너 입니다.";




    }




}
