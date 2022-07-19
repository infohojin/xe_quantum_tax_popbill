<?php
/**
 * 작성된 세금계산서 데이터를 팝빌에 저장합니다.
 * - "임시저장" 상태의 세금계산서는 발행(Issue) 함수를 호출하여 "발행완료" 처리한 경우에만 국세청으로 전송됩니다.
 * - 정발행 시 임시저장(Register)과 발행(Issue)을 한번의 호출로 처리하는 즉시발행(RegistIssue API) 프로세스 연동을 권장합니다.
 * - 역발행 시 임시저장(Register)과 역발행요청(Request)을 한번의 호출로 처리하는 즉시요청(RegistRequest API) 프로세스 연동을 권장합니다.
 * - 세금계산서 파일첨부 기능을 구현하는 경우, 임시저장(Register API) -> 파일첨부(AttachFile API) -> 발행(Issue API) 함수를 차례로 호출합니다.
 * - 역발행 세금계산서를 저장하는 경우, 객체 'Taxinvoice'의 변수 'chargeDirection' 값을 통해 과금 주체를 지정할 수 있습니다.
 *   └ 정과금 : 공급자 과금 , 역과금 : 공급받는자 과금
 * - 임시저장된 세금계산서는 팝빌 사이트 '임시문서함'에서 확인 가능합니다.
 * - https://docs.popbill.com/taxinvoice/phplaravel/api#Register
 */
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

use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\PopbillController;
class TaxinvoiceRegister extends PopbillController
{

    public function __construct()
    {
        parent::__construct(); // 팝빌 초기화

        $this->setCorpNum('8588101858'); // 퀀텀리프 사업자번호
        $this->setUserID("quantumleap"); // 퀀텀리프 팝빌 가입 아이디
    }


    public function index()
    {
        return view("tax::Taxinvoice.register");
    }

    public function CheckMgtKeyInUse(){

        // 발행유형, SELL:매출, BUY:매입, TRUSTEE:위수탁
        $mgtKeyType = TIENumMgtKeyType::SELL;

        try {
            $result = $this->PopbillTaxinvoice->CheckMgtKeyInUse($this->testCorpNum, $mgtKeyType,  $this->getInvoicerMgtKey() );
            //$result ? return false : return true;
            return $result;
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
            //return view('PResponse', ['code' => $code, 'message' => $message]);
        }
    }

    // 임시발행
    public function Register()
    {
        $this->setInvoicerMgtKey('20220405-PHP7-003'); // 세금계산서 문서번호
        if(!$this->CheckMgtKeyInUse()) {
            // 세금계산서 정보
            $this->setTaxInfo([
                'writeDate' => '20220405', // 작성일자, 형식(yyyyMMdd) 예)20150101
                'issueType' => "정발행", // 발행유형, {정발행, 역발행, 위수탁} 중 기재
                'chargeDirection' => "정과금", // 과금방향, {정과금, 역과금} 중 기재
                'purposeType' => "영수", // [영수, 청구, 없음] 중 기재
                'taxType' => '과세' // 과세형태, {과세, 영세, 면세} 중 기재
            ]);


            // 공급자 정보
            $this->setSeller([
                'invoicerCorpNum' => $this->testCorpNum, // 공급자 사업자번호
                'invoicerTaxRegID' => '', // 공급자 종사업장 식별번호, 4자리 숫자 문자열
                'invoicerCorpName' => '공급자상호', // 공급자 상호
                // 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
                'invoicerMgtKey' => $this->getInvoicerMgtKey(), // 공급자 문서번호
                'invoicerCEOName' => '공급자 대표자성명', // 공급자 대표자성명
                'invoicerAddr' => '공급자 주소', // 공급자 주소
                'invoicerBizClass' => '공급자 종목', // 공급자 종목
                'invoicerBizType' => '공급자 업태', // 공급자 업태
                'invoicerContactName' => '공급자 담당자성명', // 공급자 담당자 성명
                'invoicerEmail' => '', // 공급자 담당자 메일주소
                'invoicerTEL' => '', // 공급자 담당자 연락처
                'invoicerHP' => '', // 공급자 휴대폰 번호
                // 발행 안내 문자 전송여부 (true / false 중 택 1)
                // └ true = 전송 , false = 미전송
                // └ 공급받는자 (주)담당자 휴대폰번호 {invoiceeHP1} 값으로 문자 전송
                // - 전송 시 포인트 차감되며, 전송실패시 환불처리
                'invoicerSMSSendYN' => false
            ]);


            // 공급받는자 정보
            $this->setBuyer([
                'invoiceeType' => '사업자', // 공급받는자 구분, [사업자, 개인, 외국인] 중 기재

                // - {invoiceeType}이 "사업자" 인 경우, 사업자번호 (하이픈 ('-') 제외 10자리)
                // - {invoiceeType}이 "개인" 인 경우, 주민등록번호 (하이픈 ('-') 제외 13자리)
                // - {invoiceeType}이 "외국인" 인 경우, "9999999999999" (하이픈 ('-') 제외 13자리)
                'invoiceeCorpNum' => '8888888888', // 공급받는자 사업자번호

                'invoiceeTaxRegID' => '', // 공급받는자 종사업장 식별번호, 4자리 숫자 문자열
                'invoiceeCorpName' => '공급받는자 상호', // 공급받는자 상호
                'invoiceeMgtKey' => '', // [역발행시 필수] 공급받는자 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성

                'invoiceeCEOName' => '공급받는자 대표자성명', // 공급받는자 대표자성명
                'invoiceeAddr' => '공급받는자 주소', // 공급받는자 주소
                'invoiceeBizType' => '공급받는자 업태', // 공급받는자 업태
                'invoiceeBizClass' => '공급받는자 종목', // 공급받는자 종목
                'invoiceeContactName1' => '공급받는자 담당자성명', // 공급받는자 담당자 성명


                // 팝빌 개발환경에서 테스트하는 경우에도 안내 메일이 전송되므로,
                // 실제 거래처의 메일주소가 기재되지 않도록 주의
                'invoiceeEmail1' => '', // 공급받는자 담당자 메일주소
                'invoiceeTEL1' => '', // 공급받는자 담당자 연락처
                'invoiceeHP1' => '', // 공급받는자 담당자 휴대폰 번호

                // └ true = 전송 , false = 미전송
                // └ 공급자 담당자 휴대폰번호 {invoicerHP} 값으로 문자 전송
                // - 전송 시 포인트 차감되며, 전송실패시 환불처리
                'invoiceeSMSSendYN' => false // 역발행 안내 문자 전송여부 (true / false 중 택 1)
            ]);


            $this->setTrans([
                'supplyCostTotal' => '200000', // 공급가액 합계
                'taxTotal' => '20000', // 세액 합계
                'totalAmount' => '220000', // 합계금액, (공급가액 합계 + 세액 합계)
                'serialNum' => '', // 기재상 '일련번호'항목
                'cash' => '', // 기재상 '현금'항목
                'chkBill' => '', // 기재상 '수표'항목
                'note' => '', // 기재상 '어음'항목
                'credit' => '', // 기재상 '외상'항목

                'remark1' => '비고1', // 비고
                'remark2' => '비고2', // {invoiceeType}이 "외국인" 이면 remark1 필수
                'remark3' => '비고3', // - 외국인 등록번호 또는 여권번호 입력

                'kwon' => 1, // 기재상 '권' 항목, 최대값 32767
                'ho' => 1, // 기재상 '호' 항목, 최대값 32767

                // 사업자등록증 이미지 첨부여부 (true / false 중 택 1)
                // └ true = 첨부 , false = 미첨부(기본값)
                // - 팝빌 사이트 또는 인감 및 첨부문서 등록 팝업 URL (GetSealURL API) 함수를 이용하여 등록
                'businessLicenseYN' => false,

                // 통장사본 이미지 첨부여부 (true / false 중 택 1)
                // └ true = 첨부 , false = 미첨부(기본값)
                // - 팝빌 사이트 또는 인감 및 첨부문서 등록 팝업 URL (GetSealURL API) 함수를 이용하여 등록
                'bankBookYN' => false

                /************************************************************
                 *                     수정 세금계산서 기재정보
                 * - 수정세금계산서 관련 정보는 연동매뉴얼 또는 개발가이드 링크 참조
                 * - [참고] 수정세금계산서 작성방법 안내 - https://docs.popbill.com/taxinvoice/modify?lang=phplaravel
                 ************************************************************/

                // [수정세금계산서 작성시 필수] 수정사유코드, 수정사유에 따라 1~6중 선택기재
                // 'modifyCode' => '',

                // [수정세금계산서 작성시 필수] 원본세금계산서 국세청 승인번호 기재
                // 'orgNTSConfirmNum' => ''
            ]);

            $this->setProduct([
                [
                    'serialNum' => 1,               // [상세항목 배열이 있는 경우 필수] 일련번호 1~99까지 순차기재,
                    'purchaseDT' => '20220405',     // 거래일자
                    'itemName' => '품목명1번',      // 품명
                    'spec' => '',                   // 규격
                    'qty' => '',                    // 수량
                    'unitCost' => '',               // 단가
                    'supplyCost' => '100000',       // 공급가액
                    'tax' => '10000',               // 세액
                    'remark' => ''                 // 비고
                ],
                [
                    'serialNum' => 2,              // [상세항목 배열이 있는 경우 필수] 일련번호 1~99까지 순차기재,
                    'purchaseDT' => '20220405',     // 거래일자
                    'itemName' => '품목명1번',      // 품명
                    'spec' => '',                  // 규격
                    'qty' => '',                    // 수량
                    'unitCost' => '',               // 단가
                    'supplyCost' => '100000',       // 공급가액
                    'tax' => '10000',               // 세액
                    'remark' => ''                 // 비고
                ]
            ]);


            $contact = [
                ['contactName'=>"테스트호진",  'email'=>"infohojin@naver.com"]
            ];
            $this->setContact($contact);

            $this->writeSpecification(); // 거래명세서 동시작성여부

            //dd($this->Taxinvoice);

            try {
                $result = $this->PopbillTaxinvoice->Register(
                    $this->testCorpNum, // 팝빌 가입회원 사업자번호
                    $this->Taxinvoice,
                    $this->testUserID, // 팝빌 회원 아이디
                    $this->writeSpecification
                );
                $code = $result->code;
                $message = $result->message;
            }
            catch(PopbillException $pe) {
                $code = $pe->getCode();
                $message = $pe->getMessage();
            }

            return view('PResponse', ['code' => $code, 'message' => $message]);

        }

        return "사용중인 문서 번호 입니다.";



    }




}
