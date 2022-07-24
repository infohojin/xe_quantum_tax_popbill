<?php
use Illuminate\Support\Facades\DB;

if(!function_exists("toCamelName")) {
    function toCamelName($snake)
    {
        $names = explode('_',$snake);
        $camel = $names[0];

        for($i=1;$i<count($names);$i++) {
            $camel .= ucfirst($names[$i]);
        }
        return $camel;
    }
}

if(!function_exists("toCamelArrayName")) {
    function toCamelArrayName($arr, $skip=[])
    {
        $cols = [];
        foreach($arr as $name) {
            if(in_array($name, $skip)) continue;
            $cols[$name] = toCamelName($name);
        }
        return $cols;
    }
}

function toInsertDBObject($tablename, $obj, $skip=['id','created_at','updated_at'])
{
    $columns  = \Schema::getColumnListing($tablename);
    $cols = toCamelArrayName($columns, $skip);

    $data =[];
    $data['updated_at'] = $data['created_at'] = date("Y-m-d H:i:s");
    foreach($cols as $key=>$name) {
        if(isset($obj->$name)) $data[$key] = $obj->$name;
    }

    $data['id'] = DB::table($tablename)->insertGetId($data);
    return $data;
}


// 퀀텀 DB 파사드
function quantumShop()
{
    $rows = DB::table('xe_quantum_shop')->get();
    return $rows;
}
