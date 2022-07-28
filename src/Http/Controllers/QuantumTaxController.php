<?php

namespace XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class QuantumTaxController extends Controller
{
    /**
     * 세금계산서 데이터 목록출력
     */
    public function admin(Request $request)
    {
        $tablename = 'xe_quantum_taxbill_trans';
        $_db = DB::table($tablename);

        // 검색처리
        //$search_name = 'invoicer_corp_num';
        //$search_value = '1234567890';
        if(isset($search_name)) {
            if(is_array($search_name)) {
                // ['invoicer_corp_num'=>'1234567890']
                foreach($search_name as $key => $value) {
                    $_db = $_db->where($key, 'like',"%".$value."%");
                }
            } else {
                // 단일조건
                $_db = $_db->where($search_name, 'like',"%".$search_value."%");
            }
        }

        $rows = $_db->get();

        return view("tax::quantum.index",['rows'=>$rows]);
    }
}
