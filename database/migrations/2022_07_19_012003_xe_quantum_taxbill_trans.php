<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class XeQuantumTaxbillTrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('xe_quantum_taxbill_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            // ***** 세금계산서 정보 *****

            $table->string('issue_type')->nullable(); // [필수] 발행형태, '정발행', '역발행', '위수탁' 중 기재

            $table->string('charge_direction')->nullable(); // [필수] 과금방향,
            // - '정과금'(공급자 과금), '역과금'(공급받는자 과금) 중 기재, 역과금은 역발행시에만 가능.

            $table->string('tax_type')->nullable(); // [필수] 과세형태, '과세', '영세', '면세' 중 기재

            // 기재상 '권' 항목, 최대값 32767
            $table->string('kwon')->nullable();  // 미기재시 $Taxinvoice->kwon = null;
            // 기재상 '호' 항목, 최대값 32767
            $table->string('ho')->nullable(); // 미기재시 $Taxinvoice->ho = null;
            $table->string('invoicer_mgt_key')->nullable(); // [필수] 공급자 문서번호, 최대 24자리 숫자, 영문, '-', '_' 조합으로 사업자별로 중복되지 않도록 구성


            // ***** 공급자 정보 *****
            $table->string('invoicer_corp_num')->nullable(); // [필수] 공급자 사업자번호
            $table->string('invoicer_tax_reg_id')->nullable(); // 공급자 종사업장 식별번호, 4자리 숫자 문자열
            $table->string('invoicer_corp_name')->nullable(); // [필수] 공급자 상호

            $table->string('invoicer_ceo_name')->nullable(); // [필수] 공급자 대표자성명
            $table->string('invoicer_addr')->nullable(); // 공급자 주소
            $table->string('invoicer_biz_class')->nullable(); // 공급자 종목
            $table->string('invoicer_biz_type')->nullable(); // 공급자 업태

            $table->string('invoicer_contact_name')->nullable(); // 공급자 담당자 성명
            $table->string('invoicer_email')->nullable(); // 공급자 담당자 메일주소
            $table->string('invoicer_tel')->nullable(); // 공급자 담당자 연락처
            $table->string('invoicer_hp')->nullable(); // 공급자 휴대폰 번호
            // 발행시 알림문자 전송여부 (정발행에서만 사용가능)
            // - 공급받는자 주)담당자 휴대폰번호(invoiceeHP1)로 전송
            // - 전송시 포인트가 차감되며 전송실패하는 경우 포인트 환불처리
            $table->string('invoicer_sms_send_y_n')->nullable();


            // ***** 공급받는자 정보 *****
            $table->string('invoicee_type')->nullable(); // [필수] 공급받는자 구분, '사업자', '개인', '외국인' 중 기재


            $table->string('invoicee_corp_num')->nullable(); // [필수] 공급받는자 사업자번호
            $table->string('invoicee_tax_reg_id')->nullable(); // 공급받는자 종사업장 식별번호, 4자리 숫자 문자열
            $table->string('invoicee_corp_name')->nullable(); // [필수] 공급자 상호
            $table->string('invoicee_mgt_key')->nullable(); // [역발행시 필수] 공급받는자 문서번호, 최대 24자리 숫자, 영문, '-', '_' 조합으로 사업자별로 중복되지 않도록 구성
            $table->string('invoicee_ceo_name')->nullable(); // [필수] 공급받는자 대표자성명
            $table->string('invoicee_addr')->nullable(); // 공급받는자 주소
            $table->string('invoicee_biz_type')->nullable(); // 공급받는자 업태
            $table->string('invoicee_biz_class')->nullable(); // 공급받는자 종목
            $table->string('invoicee_contact_name1')->nullable(); // 공급받는자 담당자 성명

            $table->string('invoicee_email1')->nullable(); // 공급받는자 담당자 메일주소
            // 팝빌 개발환경에서 테스트하는 경우에도 안내 메일이 전송되므로,
            // 실제 거래처의 메일주소가 기재되지 않도록 주의

            $table->string('invoicee_tel1')->nullable();  // 공급받는자 담당자 연락처
            $table->string('invoicee_hp1')->nullable(); // 공급받는자 담당자 휴대폰 번호


            // ***** 세금계산서 기재정보 *****
            $table->string('write_date')->nullable(); // [필수] 작성일자, 형식(yyyyMMdd) 예)20150101
            $table->string('supply_cost_total')->nullable(); // [필수] 공급가액 합계
            $table->string('tax_total')->nullable(); // [필수] 세액 합계

            // 기재상 '비고' 항목
            $table->string('remark1')->nullable();
            $table->string('remark2')->nullable();
            $table->string('remark3')->nullable();

            // 결제정보
            $table->string('total_amount')->nullable(); // [필수] 합계금액, (공급가액 합계 + 세액 합계)
            $table->string('serial_num')->nullable(); // 기재상 '일련번호'항목
            $table->string('cash')->nullable(); // 기재상 '현금'항목
            $table->string('chk_bill')->nullable(); // 기재상 '수표'항목
            $table->string('note')->nullable(); // 기재상 '어음'항목
            $table->string('credit')->nullable(); // 기재상 '외상'항목

            $table->string('purpose_type')->nullable(); // [필수] '영수', '청구', '없음' 중 기재





            $table->string('business_license_y_n')->nullable(); // 사업자등록증 이미지파일 첨부여부
            $table->string('bank_book_y_n')->nullable(); // 통장사본 이미지파일 첨부여부

            /************************************************************
             * 수정 세금계산서 기재정보
             * - 수정세금계산서 관련 정보는 연동매뉴얼 또는 개발가이드 링크 참조
             * - [참고] 수정세금계산서 작성방법 안내 - http://blog.linkhubcorp.com/650
             ************************************************************/

            // [수정세금계산서 작성시 필수] 수정사유코드, 수정사유에 따라 1~6중 선택기재
            //$Taxinvoice->modifyCode = '';
            $table->string('modify_code')->nullable();

            // [수정세금계산서 작성시 필수] 수정세금계산서 작성시 원본세금계산서의 국세청승인번호 기재
            //$Taxinvoice->orgNTSConfirmNum = '';
            $table->string('org_nts_confirm_num')->nullable();

            $table->string('detail_id')->nullable();
            $table->string('contact_id')->nullable();

            $table->string('status')->nullable();
            $table->string('edited')->nullable();
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
