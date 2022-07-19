<?php

namespace XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers;

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
;

class PopbillController extends Controller
{
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
}
