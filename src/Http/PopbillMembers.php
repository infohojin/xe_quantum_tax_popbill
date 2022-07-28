<?php

namespace XEHub\XePlugin\CustomQuantum\Tax\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Linkhub\Popbill\PopbillException;

class PopbillMembers
{
    private $PopbillTaxinvoice;
    public function __construct($PopbillTaxinvoice) {
        $this->PopbillTaxinvoice = $PopbillTaxinvoice;
    }

    public function joinMember($joinForm)
    {
        try {
            $result = $this->PopbillTaxinvoice->JoinMember($joinForm);
            $code = $result->code;
            $message = $result->message;
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
        }

        return [
            'code' => $code,
            'message' => $message
        ];
    }

    /**
     * 사용하고자 하는 아이디의 중복여부를 확인합니다.
     * - https://docs.popbill.com/taxinvoice/phplaravel/api#CheckID
     */
    public function checkID($id)
    {
        try {
            $result = $this->PopbillTaxinvoice->CheckID($id);
            $code = $result->code;
            $message = $result->message;
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
        }

        return ['code' => $code, 'message' => $message];
    }

    public function factoryJoinForm()
    {
        return new class {
            public $LinkID;
            public $CorpNum;
            public $CEOName;
            public $CorpName;
            public $Addr;
            public $ZipCode;
            public $BizType;
            public $BizClass;
            public $ContactName;
            public $ContactEmail;
            public $ContactTEL;
            public $ContactHP;
            public $ContactFAX;
            public $ID;
            public $PWD;
            public $Password;
        };
    }

    public function getTaxCertURL($popbill_id, $corpNum)
    {
        try {
            $url = $this->PopbillTaxinvoice->GetTaxCertURL($corpNum, $popbill_id);
            return $url;

        } catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
            return ['code' => $code, 'message' => $message];
        }
    }

    /**
     * 팝빌 인증서버에 등록된 공동인증서의 정보를 확인합니다.
     * - https://docs.popbill.com/taxinvoice/phplaravel/api#GetTaxCertInfo
     */
    public function getTaxCertInfo($popbill_id, $corpNum)
    {
        try {
            $taxinvoiceCertificate = $this->PopbillTaxinvoice->GetTaxCertInfo($corpNum, $popbill_id);
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
            return ['code' => $code, 'message' => $message];
        }

        return $taxinvoiceCertificate;
    }

    /**
     * 연동회원의 회사정보를 확인합니다.
     * - https://docs.popbill.com/taxinvoice/phplaravel/api#GetCorpInfo
     */
    public function getCorpInfo()
    {

        // 팝빌회원 사업자번호, '-' 제외 10자리
        $testCorpNum = '1234567890';

        // 팝빌 회원 아이디
        $testUserID = 'qt_1234';

        try {
            $CorpInfo = $this->PopbillTaxinvoice->GetCorpInfo($testCorpNum, $testUserID);
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
            return ['code' => $code, 'message' => $message];
        }

        return $CorpInfo;
    }


}
