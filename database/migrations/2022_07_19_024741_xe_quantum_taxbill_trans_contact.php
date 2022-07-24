<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class XeQuantumTaxbillTransContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('xe_quantum_taxbill_contact', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            /************************************************************
             * 추가담당자 정보
             * - 세금계산서 발행안내 메일을 수신받을 공급받는자 담당자가 다수인 경우
             * 추가 담당자 정보를 등록하여 발행안내메일을 다수에게 전송할 수 있습니다. (최대 5명)
             ************************************************************/
            $table->string('serial_num')->nullable(); // 일련번호 1부터 순차기재
            $table->string('email')->nullable(); // 이메일주소 'test@test.com'
            $table->string('contact_name')->nullable(); // 담당자명 '팝빌담당자'

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
