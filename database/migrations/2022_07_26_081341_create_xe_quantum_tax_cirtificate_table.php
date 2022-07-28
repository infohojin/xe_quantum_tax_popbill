<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXeQuantumTaxCirtificateTable extends Migration
{
    /**
     * 세금계산서 연동 인증서 관리 테이블
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xe_quantum_tax_cirtificate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            // 사용자id
            $table->string('user_id');

            // 샵id(파트너)
            $table->string('shop_id');

            $table->string('cirtificate');
            $table->string('cirtificate_expire_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xe_quantum_tax_cirtificate');
    }
}
