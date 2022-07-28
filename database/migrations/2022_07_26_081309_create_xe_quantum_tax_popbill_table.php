<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXeQuantumTaxPopbillTable extends Migration
{
    /**
     * 세금계산서 연동정보 테이블
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xe_quantum_tax_popbill', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            // 사용자id
            $table->string('user_id');

            // 샵id(파트너)
            $table->string('shop_id');

            // 연동상태
            $table->string('status');

            // 팝빌아이디
            $table->string('popbill_id');

            // 가입회사 정보
            $table->string('corp_num');
            $table->string('ceo_name');
            $table->string('corp_name');
            $table->string('addr');
            $table->string('zip_code');
            $table->string('biz_type');
            $table->string('biz_class');
            $table->string('contact_name');

            $table->string('contact_email');
            $table->string('contact_hp');
            $table->string('contact_fax');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xe_quantum_tax_popbill');
    }
}
