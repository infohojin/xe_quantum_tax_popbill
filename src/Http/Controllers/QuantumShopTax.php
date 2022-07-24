<?php

namespace XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class QuantumShopTax extends Controller
{
    public function shopall()
    {
        $rows = quantumShop();
        return view("tax::shop.all",['shop'=>$rows]);
    }

    /**
     * 퀀텀 발행된 세금목록
     */
    public function taxlist()
    {
        $rows = DB::table('xe_quantum_taxbill_trans')->get();
        return view("tax::tax.quantum",['trans'=>$rows]);
    }

    /**
     * 샵 발행된 세금목록
     */
    public function shoptax(Request $request)
    {
        $shop = DB::table('xe_quantum_shop')->where('shop_id', $request->uuid)->first();

        $rows = DB::table('xe_quantum_taxbill_trans')->where('invoicer_corp_num', $shop->business_id)->get();
        return view("tax::tax.shop",['trans'=>$rows]);
    }


}
