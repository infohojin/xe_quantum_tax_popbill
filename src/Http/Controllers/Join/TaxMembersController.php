<?php
namespace XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\Join;

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

use XEHub\XePlugin\CustomQuantum\Tax\Http\PopbillMembers;

class TaxMembersController extends Controller
{
    private $prefix = "qtlf";

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
    }


    /**
     * 링크허브 연동회원가입
     */
    public function join(Request $request)
    {
        $shop_id = $request->uuid;

        // 샵정보
        $shop = DB::table('xe_quantum_shop')->where('shop_id', $shop_id)->first();
        if($shop) {

            // 샵 가입여부 확인
            // 자체 DB 자료 체크
            $row = DB::table('xe_quantum_tax_popbill')->where('shop_id', $shop_id)->first();
            if($row) {
                return "이미 가입된 회원입니다.";
            }

            return view("tax::shop.member.join",['shop'=>$shop]);
        }

        return "등록된 숍 id가 아닙니다.";
    }

    /**
     * API 호출을 통해, 연동회원 가입을 처리합니다.
     */
    public function regist(Request $request)
    {
        // 샵정보
        $shop_id = $request->uuid;
        $shop = DB::table('xe_quantum_shop')->where('shop_id', $shop_id)->first();
        if($shop) {

            $obj = new PopbillMembers($this->PopbillTaxinvoice);

            // 아이디, 6자 이상 20자미만
            $linkhub_id = $this->prefix."_".str_replace('-',"",$shop->business_id);


            // 샵id 중복여부 조회
            $result = $obj->checkID($linkhub_id);
            if($result['code']) {
                // 오류 메시지 출력
                return $result['code']." ".$result['message'];
            }


            // 회원 데이터 바인딩
            $joinForm = $obj->factoryJoinForm();
            $joinForm->LinkID = config('popbill.LinkID'); // 링크아이디
            $joinForm->ID = $linkhub_id; // 연동회원 신규가입 아이디
            // 비밀번호, 8자 이상 20자 이하(영문, 숫자, 특수문자 조합)
            // prefix+!@+사업자앞3자리
            $joinForm->Password = $this->prefix.'!@'.substr($shop->business_id,0,3);

            $business_license_number = substr(str_replace('-',"",$shop->business_id),0,10);

            $joinForm->CorpNum = $business_license_number; // 사업자번호, "-"제외 10자리
            $joinForm->CEOName = $shop->ceo_name; // 대표자성명
            $joinForm->CorpName = $shop->business_name; // 사업자상호
            $joinForm->Addr = $shop->address." ".$shop->detail_address; // 사업자주소
            $joinForm->Addr = $shop->zip_code;
            $joinForm->BizType = $shop->business_condition; // 업태
            $joinForm->BizClass = $shop->business_type; // 종목

            // 담당자 정보
            $joinForm->ContactName = $shop->ceo_name; // 담당자명 (대표자명으로 설정협의)
            $joinForm->ContactEmail = $shop->shop_email; // 담당자 이메일
            $joinForm->ContactTEL = $shop->shop_phone_number; // 샵 일반전화
            $joinForm->ContactHP = $shop->shop_phone_number; // 담당자 연락처
            $joinForm->ContactFAX = $shop->shop_phone_number; // 팩스번호


            // 링크허브 회원가입 API 호출
            $result = $obj->joinMember($joinForm);
            //dd($result);
            if( $result['code'] == 0) {
                //DB저장
                DB::table('xe_quantum_tax_popbill')->insert([
                    // 사용자id
                    'user_id'=>"",

                    // 샵id(파트너)
                    'shop_id'=>$shop_id,

                    // 연동상태
                    'status'=>"1",

                    // 팝빌아이디
                    'popbill_id'=>$linkhub_id,

                    // 가입회사 정보
                    'corp_num'=>$business_license_number,
                    'ceo_name'=>$shop->ceo_name,
                    'corp_name'=>$shop->business_name,
                    'addr'=>$shop->address." ".$shop->detail_address,
                    'zip_code'=>$shop->zip_code,
                    'biz_type'=>$shop->business_condition,
                    'biz_class'=>$shop->business_type,

                    'contact_name'=>$shop->ceo_name,
                    'contact_email'=>$shop->shop_email,
                    'contact_hp'=>$shop->shop_phone_number,
                    'contact_fax'=>$shop->shop_phone_number,

                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ]);
            }

            //dump($result);
            //dump($linkhub_id);
            //dump($business_license_number);
            $linkhub_id = 'qt_1234';
            $business_license_number = "1234567890";
            $url = $obj->getTaxCertURL($linkhub_id, $business_license_number);
            //dd($url);
            if(is_string($url)) {
                $result['url'] = $url;
            } else {
                return "인증서 등록 url을 얻을 수 없습니다.";
            }



            $result['shop'] = $shop; // 샵정보 추가
            return view('tax::shop.member.result', $result);

        }

        return "등록된 숍 id가 아닙니다.";
    }


    public function certificate(Request $request)
    {
        // 샵정보
        $shop_id = $request->uuid;
        $shop = DB::table('xe_quantum_shop')->where('shop_id', $shop_id)->first();
        if($shop) {
            $popbill = DB::table('xe_quantum_tax_popbill')->where('shop_id',$shop_id)->first();

            $obj = new PopbillMembers($this->PopbillTaxinvoice);
            $popbill_id = $popbill->popbill_id;
            //$popbill_id = "1234567899";

            // ===== 인증서 정보
            $result = $obj->getTaxCertInfo($popbill_id, $popbill->corp_num);

            if(is_array($result)) {
                // 인증서 정보가 없습니다.
                $cert = "";
            } else {
                $cert = $result;
            }

            // ===== 인증서 url
            $linkhub_id = 'qt_1234';
            $business_license_number = "1234567890";
            $url = $obj->getTaxCertURL($linkhub_id, $business_license_number);
            //dd($url);
            if(!is_string($url)) {
                return "인증서 등록 url을 얻을 수 없습니다.";
            }

            // === 회사정보 확인
            //$this->UpdateCorpInfo();
            $info = $obj->getCorpInfo();
            //dd($info);


            return view('tax::shop.member.certificate', [
                'shop'=>$shop,
                'cert'=>$cert,
                'url'=>$url
            ]);
        }
        return "등록된 숍 id가 아닙니다.";
    }






    /**
     * 연동회원의 회사정보를 수정합니다.
     * - https://docs.popbill.com/taxinvoice/phplaravel/api#UpdateCorpInfo
     */
    public function UpdateCorpInfo()
    {

        // 팝빌회원 사업자번호, '-' 제외 10자리
        $testCorpNum = '1234567890';

        // 회사정보 클래스 생성
        $CorpInfo = new CorpInfo();

        // 대표자명
        $CorpInfo->ceoname = '대표자명2';

        // 상호
        $CorpInfo->corpName = '링크허브';

        // 주소
        $CorpInfo->addr = '서울시 강남구 영동대로';

        // 업태
        $CorpInfo->bizType = '업태';

        // 종목
        $CorpInfo->bizClass = '종목';

        // 팝빌 회원 아이디
        $testUserID = 'qt_1234';

        try {
            $result =  $this->PopbillTaxinvoice->UpdateCorpInfo($testCorpNum, $CorpInfo, $testUserID);
            $code = $result->code;
            $message = $result->message;
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
        }

        return ['code' => $code, 'message' => $message];
    }




    /**
     * 전자세금계산서 발행에 필요한 인증서를 팝빌 인증서버에 등록하기 위한 페이지의 팝업 URL을 반환합니다.
     * - 반환되는 URL은 보안 정책상 30초 동안 유효하며, 시간을 초과한 후에는 해당 URL을 통한 페이지 접근이 불가합니다.
     * - 인증서 갱신/재발급/비밀번호 변경한 경우, 변경된 인증서를 팝빌 인증서버에 재등록 해야합니다.
     * - https://docs.popbill.com/taxinvoice/phplaravel/api#GetTaxCertURL
     */
    public function GetTaxCertURL()
    {
        //return "aaa";

        // 팝빌 회원 사업자 번호, "-"제외 10자리
        $testCorpNum = '1234567890';

        // 팝빌 회원 아이디
        $testUserID = 'qt_1234';

        try {
            $url = $this->PopbillTaxinvoice->GetTaxCertURL($testCorpNum, $testUserID);
        } catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
            return view('PResponse', ['code' => $code, 'message' => $message]);
        }

        return view('tax::shop.member.certurl',['url'=>$url]);
        return view('tax::ReturnValue', ['filedName' => "공인인증서 등록 URL" , 'value' => $url]);
    }
}
