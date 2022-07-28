<?php
/**
 * 세금계산서 데이터 처리 객체
 */
namespace XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\Trans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class InvoiceBuilder
{
    public $created_at;
    public $updated_at;
    public $write_date;
    public $issue_type;
    public $charge_direction;
    public $purpose_type;
    public $tax_type;

    public $invoicer_corp_num;
    public $invoicer_tax_reg_id;
    public $invoicer_corp_name;
    public $invoicer_mgt_key;
    public $invoicer_ceo_name;
    public $invoicer_addr;
    public $invoicer_biz_class;
    public $invoicer_biz_type;
    public $invoicer_contact_name;
    public $invoicer_email;
    public $invoicer_tel;
    public $invoicer_hp;
    public $invoicer_sms_send_y_n;

    public $invoicee_type;
    public $invoicee_corp_num;
    public $invoicee_tax_reg_id;
    public $invoicee_corp_name;
    public $invoicee_mgt_key;
    public $invoicee_ceo_name;
    public $invoicee_addr;
    public $invoicee_biz_type;
    public $invoicee_biz_class;
    public $invoicee_contact_name1;
    public $invoicee_email1;
    public $invoicee_tel1;
    public $invoicee_hp1;

    public $supply_cost_total;
    public $tax_total;
    public $total_amount;
    public $serial_num;
    public $cash;
    public $chk_bill;
    public $note;
    public $credit;
    public $remark1;
    public $remark2;
    public $remark3;
    public $kwon;
    public $ho;
    public $business_license_y_n;
    public $bank_book_y_n;
    public $modify_code;
    public $org_nts_confirm_num;
    public $detail_id;
    public $contact_id;
    public $status;
    public $edited;

    public function __construct()
    {
        // 초기화
        $this->write_date = date("Ymd");

        // 세금계산서 발행 정보(초기값)
        $this->issue_type="정발행";
        $this->charge_direction="정과금";
        $this->purpose_type="영수";
        $this->tax_type='과세';
    }

    public function setShopInfo($shop)
    {
        $business_license_number = substr(str_replace('-',"",$shop->business_id),0,10);
        $this->invoicer_corp_num = $business_license_number;

        $this->invoicer_corp_name = $shop->business_name;
        $this->invoicer_ceo_name = $shop->ceo_name;
        $this->invoicer_addr = $shop->address." ".$shop->detail_address;
        $this->invoicer_biz_class = $shop->business_condition;
        $this->invoicer_biz_type = $shop->business_type;

        $this->invoicer_contact_name = $shop->ceo_name;
        $this->invoicer_email = $shop->shop_email;
        $this->invoicer_tel = $shop->shop_phone_number;
        $this->invoicer_hp = $shop->shop_phone_number;

        return $this;
    }

    public function setInvoiceeType($type="사업자")
    {
        // 공급받는자 구분, [사업자, 개인, 외국인] 중 기재
        $this->invoiceeType = $type;
        return $this;
    }

    public function setDesignerInfo($arr)
    {
        // - {invoiceeType}이 "사업자" 인 경우, 사업자번호 (하이픈 ('-') 제외 10자리)
        // - {invoiceeType}이 "개인" 인 경우, 주민등록번호 (하이픈 ('-') 제외 13자리)
        // - {invoiceeType}이 "외국인" 인 경우, "9999999999999" (하이픈 ('-') 제외 13자리)
        $this->invoicee_corp_num = '8888888888'; // 공급받는자 사업자번호

        $this->invoicee_tax_reg_id = ''; // 공급받는자 종사업장 식별번호, 4자리 숫자 문자열
        $this->invoicee_corp_name = '공급받는자 상호'; // 공급받는자 상호

        $this->invoicee_ceo_name = '공급받는자 대표자성명'; // 공급받는자 대표자성명
        $this->invoicee_addr = '공급받는자 주소'; // 공급받는자 주소
        $this->invoicee_biz_type = '공급받는자 업태'; // 공급받는자 업태
        $this->invoicee_biz_class = '공급받는자 종목'; // 공급받는자 종목
        $this->invoicee_contact_name1 = '공급받는자 담당자성명'; // 공급받는자 담당자 성명


        // 팝빌 개발환경에서 테스트하는 경우에도 안내 메일이 전송되므로,
        // 실제 거래처의 메일주소가 기재되지 않도록 주의
        $this->invoicee_email1 = ''; // 공급받는자 담당자 메일주소
        $this->invoicee_tel1 = ''; // 공급받는자 담당자 연락처
        $this->invoicee_hp1 = ''; // 공급받는자 담당자 휴대폰 번호

        return $this;
    }


}
