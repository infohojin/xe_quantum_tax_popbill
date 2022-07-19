<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class XeQuantumTaxbillTransDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ***** 상세항목(품목) 정보 *****
        Schema::create('xe_quantum_taxbill_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('serial_num')->nullable(); // [상세항목 배열이 있는 경우 필수] 일련번호 1~99까지 순차기재,
            $table->string('purchase_dt')->nullable(); // 거래일자 '20220101'

            $table->string('item_name')->nullable(); // 품명 '품목명1번'
            $table->string('spec')->nullable(); // 규격
            $table->string('qty')->nullable(); // 수량
            $table->string('unit_cost')->nullable(); // 단가
            $table->string('supply_cost')->nullable(); // 공급가액
            $table->string('tax')->nullable(); // 세액
            $table->string('remark')->nullable(); // 비고

            $table->string('trans_id')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
