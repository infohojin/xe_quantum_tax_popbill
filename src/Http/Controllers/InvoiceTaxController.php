<?php

namespace XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class InvoiceTaxController extends Controller
{
    /**
     * 세금계산서 데이터 목록출력
     */
    public function admin(Request $request)
    {
        $tablename = 'xe_quantum_taxbill_trans';
        $rows = DB::table($tablename)->get();
        return view("tax::quantum.index",['rows'=>$rows]);
    }



}
