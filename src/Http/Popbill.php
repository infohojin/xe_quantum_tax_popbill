<?php

namespace XEHub\XePlugin\CustomQuantum\Tax\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



use Linkhub\LinkhubException;
use Linkhub\Popbill\JoinForm;
use Linkhub\Popbill\CorpInfo;
use Linkhub\Popbill\ContactInfo;
use Linkhub\Popbill\ChargeInfo;
use Linkhub\Popbill\PopbillException;
use Linkhub\Popbill\PopbillTaxinvoice;
use Linkhub\Popbill\TIENumMgtKeyType;
use Linkhub\Popbill\Taxinvoice;
use Linkhub\Popbill\TaxinvoiceDetail;
use Linkhub\Popbill\TaxinvoiceAddContact;

use Illuminate\Support\Facades\DB;

class Popbill
{
    const TABLENAME = "xe_quantum_taxbill_trans";

    protected $Taxinvoice;

    protected $testCorpNum = '1234567890'; // 팝빌회원 사업자번호, '-' 제외 10자리
    protected $testUserID = 'testkorea'; // 팝빌 회원 아이디
    protected $invoicerMgtKey;

    // 거래명세서 동시작성여부
    protected $writeSpecification = false;


    public function __construct() {
        // 통신방식 설정
        define('LINKHUB_COMM_MODE', config('popbill.LINKHUB_COMM_MODE'));

        // 세금계산서 서비스 클래스 초기화
        $this->PopbillTaxinvoice = new PopbillTaxinvoice(config('popbill.LinkID'), config('popbill.SecretKey'));

        // 연동환경 설정값, true-개발용, false-상업용
        $this->PopbillTaxinvoice->IsTest(config('popbill.IsTest'));

        // 인증토큰의 IP제한기능 사용여부, true-사용, false-미사용, 기본값(true)
        $this->PopbillTaxinvoice->IPRestrictOnOff(config('popbill.IPRestrictOnOff'));

        // 팝빌 API 서비스 고정 IP 사용여부, true-사용, false-미사용, 기본값(false)
        $this->PopbillTaxinvoice->UseStaticIP(config('popbill.UseStaticIP'));

        // 로컬서버 시간 사용 여부, true-사용, false-미사용, 기본값(true)
        $this->PopbillTaxinvoice->UseLocalTimeYN(config('popbill.UseLocalTimeYN'));


        // 세금계산서 객체 생성
        $this->Taxinvoice = new Taxinvoice();
    }

    protected function setCorpNum($num)
    {
        $this->testCorpNum = $num;
        return $this;
    }

    protected function getCorpNum()
    {
        return $this->testCorpNum;
    }

    protected function setUserID($userid)
    {
        $this->testUserID = $userid;
        return $this;
    }

    protected function writeSpecification($value=false)
    {
        // └ true = 사용 , false = 미사용
        // - 미입력 시 기본값 false 처리
        $this->writeSpecification = false;
        return $this;
    }

    protected function setTaxInfo($args)
    {
        foreach($args as $key=>$value)
        {
            $this->Taxinvoice->$key = $value;
        }
        return $this;
    }

    protected function setSeller($args)
    {
        foreach($args as $key=>$value)
        {
            $this->Taxinvoice->$key = $value;
        }
        return $this;
    }

    protected function setBuyer($args)
    {
        foreach($args as $key=>$value)
        {
            $this->Taxinvoice->$key = $value;
        }
        return $this;
    }

    protected function setInvoicerMgtKey($docid)
    {
        // - 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
        $this->invoicerMgtKey = $docid;
        return $this;
    }

    protected function getInvoicerMgtKey()
    {
        return $this->invoicerMgtKey;
    }

    // 상세항목(품목) 정보
    protected function setProduct($argss)
    {
        $detailList = array();
        $temp = new TaxinvoiceDetail();

        foreach($argss as $args) {
            $list = clone $temp;

            foreach($args as $key=>$value)
            {
                $list->$key = $value;
            }

            $detailList []= $list;
        }

        $this->Taxinvoice->detailList = $detailList;

        return $this;
    }


    // 세금계산서 기재정보
    protected function setTrans($args)
    {
        foreach($args as $key=>$value)
        {
            $this->Taxinvoice->$key = $value;
        }
        return $this;
    }

    protected function setContact($argss)
    {
        /************************************************************
         *                      추가담당자 정보
         * - 세금계산서 발행안내 메일을 수신받을 공급받는자 담당자가 다수인 경우
         ************************************************************/
        $addContactList = array();
        $temp = new TaxinvoiceAddContact();

        foreach($argss as $i => $args) {
            // * 추가 담당자 정보를 등록하여 발행안내메일을 다수에게 전송할 수 있습니다.
            // (최대 5명)
            if( $i>=5 ) break;

            $contact = clone $temp;

            $contact->serialNum = $i+1;
            foreach($args as $key=>$value)
            {
                $contact->$key = $value;
            }

            $addContactList []= $contact;
        }

        $this->Taxinvoice->addContactList = $addContactList;
        return $this;
    }

    protected function fieldName($key)
    {
        $fields = [
            'write_date'=>"writeDate",
            'issue_type'=>"issueType",
            'charge_direction'=>"chargeDirection",
            'purpose_type'=>"purposeType",
            'tax_type'=>"taxType",
            'invoicer_corp_num'=>"invoicerCorpNum",
            'invoicer_tax_reg_id'=>"invoicerTaxRegID",
            'invoicer_corp_name'=>"invoicerCorpName",
            'invoicer_mgt_key'=>"",
            'invoicer_ceo_name'=>"invoicerCEOName",
            'invoicer_addr'=>"invoicerAddr",
            'invoicer_biz_class'=>"invoicerBizClass",
            'invoicer_biz_type'=>"invoicerBizType",
            'invoicer_contact_name'=>"invoicerContactName",
            'invoicer_email'=>"invoicerEmail",
            'invoicer_tel'=>"invoicerTEL",
            'invoicer_hp'=>"invoicerHP",
            'invoicer_sms_send_y_n'=>"invoicerSMSSendYN",
            'invoicee_type'=>"invoiceeType",
            'invoicee_corp_num'=>"invoiceeCorpNum",
            'invoicee_tax_reg_id'=>"invoiceeTaxRegID",
            'invoicee_corp_name'=>"invoiceeCorpName",
            'invoicee_mgt_key'=>"invoiceeMgtKey",
            'invoicee_ceo_name'=>"invoiceeCEOName",
            'invoicee_addr'=>"invoiceeAddr",
            'invoicee_biz_type'=>"invoiceeBizType",
            'invoicee_biz_class'=>"invoiceeBizClass",
            'invoicee_contact_name1'=>"invoiceeContactName1",
            'invoicee_email1'=>"invoiceeEmail1",
            'invoicee_tel1'=>"invoiceeTEL1",
            'invoicee_hp1'=>"invoiceeHP1",
            'supply_cost_total'=>"supplyCostTotal",
            'tax_total'=>"taxTotal",
            'total_amount'=>"totalAmount",
            'serial_num'=>"serialNum",
            'cash'=>"cash",
            'chk_bill'=>"chkBill",
            'note'=>"note",
            'credit'=>"credit",
            'remark1'=>"remark1",
            'remark2'=>"remark2",
            'remark3'=>"remark3",
            'kwon'=>"kwon",
            'ho'=>"ho",
            'business_license_y_n'=>"businessLicenseYN",
            'bank_book_y_n'=>"bankBookYN",
            'modify_code'=>"modifyCode",
            'org_nts_confirm_num'=>"orgNTSConfirmNum",

            'purchase_dt' => 'purchaseDT',
            'item_name'=>"itemName",
            'spec'=>"spec",
            'qty'=>"qty",
            'unit_cost'=>"unitCost",
            'supply_cost'=>"supplyCost",
            'tax'=>"tax",
            'remark'=>"remark",

            'serial_num'=>"serialNum",
            'email'=>"email",
            'contact_name'=>"contactName"

        ];

        return $fields[$key];
    }

    /**
     * 세금계산서 문서번호 생성
     */
    public function invoiceMgtKeyGen($prefix)
    {
        $max = DB::table(self::TABLENAME)->count();
        return $prefix."-".sprintf('%03d', $max+1);
    }

    /*
    public function CheckMgtKeyInUse(){

        // 발행유형, SELL:매출, BUY:매입, TRUSTEE:위수탁
        $mgtKeyType = TIENumMgtKeyType::SELL;

        try {
            $result = $this->PopbillTaxinvoice->CheckMgtKeyInUse($this->testCorpNum, $mgtKeyType,  $this->getInvoicerMgtKey() );
            //$result ? return false : return true;
            //return $result;
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();

            //return view('PResponse', ['code' => $code, 'message' => $message]);
        }
    }
    */

    // 작성일자
    public function setWriteDate($date=null)
    {
        if($date) {
            $this->Taxinvoice->writeDate = $date;
        } else {
            //형식(yyyyMMdd) 예)20150101
            $this->Taxinvoice->writeDate = date("Ymd");
        }

        return $this;
    }

    /**
     * 발행유형
     */
    public function setIssueType($type="정발행")
    {
        // 정발행
        // 역발행
        // 위수탁
        $this->Taxinvoice->issueType = $type;
        return $this;
    }

    // 과금방향, {정과금, 역과금} 중 기재
    public function setChargeDirection($charge = "정과금")
    {
        $this->Taxinvoice->chargeDirection = $charge;
        return $this;
    }

    // [영수, 청구, 없음] 중 기재
    public function setPurposeType($purpose="영수"){
        $this->Taxinvoice->purposeType = $purpose;
        return $this;
    }

    // 과세형태, {과세, 영세, 면세} 중 기재
    public function setTaxType($tax='과세'){
        $this->Taxinvoice->taxType = $tax;
        return $this;
    }

    /**
     * 발행 안내 문자 전송여부 (true / false 중 택 1)
     */
    public function setInvoicerSMSSendYN($status=false)
    {
        // └ true = 전송 , false = 미전송
        // └ 공급받는자 (주)담당자 휴대폰번호 {invoiceeHP1} 값으로 문자 전송
        // - 전송 시 포인트 차감되며, 전송실패시 환불처리
        $this->Taxinvoice->invoicerSMSSendYN = $status;
        return $this;
    }


    /**
     * 역발행 안내 문자 전송여부 (true / false 중 택 1)
     * 공급자 담당자 휴대폰번호 {invoicerHP} 값으로 문자 전송
     */
    public function setInvoiceeSMSSendYN($status=false)
    {
        // └ true = 전송 , false = 미전송
        // - 전송 시 포인트 차감되며, 전송실패시 환불처리
        $this->Taxinvoice->invoiceeSMSSendYN = $status;
        return $this;
    }





}
