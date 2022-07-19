<h1>정발행 임시저장</h1>

<form action="/Taxinvoice/Register" method="POST">
    사업자번호: <input type="corpName">

    {{-- 공급자 정보 --}}
    <fieldset class="fieldset1">
        <legend>공급자정보</legend>
        <ul>
            <li>
                <label for="">공급자 사업자번호</label>
                <input type="text" name="invoicerCorpNum" />
            </li>
            <li>
                <label for="">공급자 종사업장 식별번호, 4자리 숫자 문자열</label>
                <input type="text" name="invoicerTaxRegID" />
            </li>
            <li>
                <label for="">공급자 상호</label>
                <input type="text" name="invoicerCorpName" />
            </li>
            <li>
                <label for="">공급자 문서번호</label>
                <input type="text" name="invoicerMgtKey" />
                <p>최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성</p>
            </li>
            <li>
                <label for="">공급자 대표자성명</label>
                <input type="text" name="invoicerCEOName" />
            </li>
            <li>
                <label for="">공급자 주소</label>
                <input type="text" name="invoicerAddr" />
            </li>
            <li>
                <label for="">공급자 종목</label>
                <input type="text" name="invoicerBizClass" />
            </li>
            <li>
                <label for="">공급자 업태</label>
                <input type="text" name="invoicerBizType" />
            </li>
            <li>
                <label for="">공급자 담당자 성명</label>
                <input type="text" name="invoicerContactName" />
            </li>
            <li>
                <label for="">공급자 담당자 메일주소</label>
                <input type="text" name="invoicerEmail" />
            </li>
            <li>
                <label for="">공급자 담당자 연락처</label>
                <input type="text" name="invoicerTEL" />
            </li>
            <li>
                <label for="">공급자 휴대폰 번호</label>
                <input type="text" name="invoicerHP" />
            </li>
            <li>
                <label for=""> 발행 안내 문자 전송여부 (true / false 중 택 1)</label>
                <input type="text" name="invoicerSMSSendYN" value="false"/>
                <p>
                발행 안내 문자 전송여부 (true / false 중 택 1)
                └ true = 전송 , false = 미전송
                └ 공급받는자 (주)담당자 휴대폰번호 {invoiceeHP1} 값으로 문자 전송
                - 전송 시 포인트 차감되며, 전송실패시 환불처리
                </p>
            </li>
        </ul>
    </fieldset>

    {{-- 공급받는자 정보 --}}
    <fieldset class="fieldset1">
        <legend>공급자 받는자</legend>
        <ul>
            <li>
                <label for="">공급받는자 구분, [사업자, 개인, 외국인] 중 기재</label>
                <input type="text" name="invoiceeType" />
                <p>

                </p>
            </li>
            <li>
                <label for="">공급받는자 사업자번호</label>
                <input type="text" name="invoiceeCorpNum" />
                <p>
                    // - {invoiceeType}이 "사업자" 인 경우, 사업자번호 (하이픈 ('-') 제외 10자리)
                // - {invoiceeType}이 "개인" 인 경우, 주민등록번호 (하이픈 ('-') 제외 13자리)
                // - {invoiceeType}이 "외국인" 인 경우, "9999999999999" (하이픈 ('-') 제외 13자리)
                </p>
            </li>
            <li>
                <label for="">공급받는자 종사업장 식별번호, 4자리 숫자 문자열</label>
                <input type="text" name="invoiceeTaxRegID" />
            </li>
            <li>
                <label for="">공급받는자 상호</label>
                <input type="text" name="invoiceeCorpName" />
            </li>
            <li>
                <label for=""></label>
                <input type="text" name="invoiceeMgtKey" />
                <p>
                    [역발행시 필수] 공급받는자 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
                </p>
            </li>
            <li>
                <label for="">공급받는자 대표자성명</label>
                <input type="text" name="invoiceeCEOName" />
            </li>
            <li>
                <label for="">공급받는자 주소</label>
                <input type="text" name="invoiceeAddr" />
            </li>
            <li>
                <label for="">공급받는자 업태</label>
                <input type="text" name="invoiceeBizType" />
            </li>
            <li>
                <label for="">공급받는자 종목</label>
                <input type="text" name="invoiceeBizClass" />
            </li>
            <li>
                <label for="">공급받는자 담당자 성명</label>
                <input type="text" name="invoiceeContactName1" />
            </li>

            <li>
                <label for="">공급받는자 담당자 메일주소</label>
                <input type="text" name="invoiceeEmail1" />
            </li>
            <li>
                <label for="">공급받는자 담당자 연락처</label>
                <input type="text" name="invoiceeTEL1" />
            </li>
            <li>
                <label for="">공급받는자 담당자 휴대폰 번호</label>
                <input type="text" name="invoiceeHP1" />
            </li>
            <li>
                <label for="">대폰번호 {invoicerHP} 값으로 문자 전송</label>
                <input type="text" name="invoiceeSMSSendYN" value="false"/>
                <p>
                    // └ true = 전송 , false = 미전송
                // └ 공급자 담당자 휴대폰번호 {invoicerHP} 값으로 문자 전송
                // - 전송 시 포인트 차감되며, 전송실패시 환불처리
                '' => false // 역발행 안내 문자 전송여부 (true / false 중 택 1)
                </p>
            </li>

        </ul>
    </fieldset>

    {{-- 기재정보 --}}
    <fieldset class="fieldset1">
        <legend>공급자 받는자</legend>
        <ul>
            <li>
                <label for="">공급가액 합계</label>
                <input type="text" name="supplyCostTotal" />
            </li>
            <li>
                <label for="">세액 합계</label>
                <input type="text" name="taxTotal" />
            </li>
            <li>
                <label for="">합계금액, (공급가액 합계 + 세액 합계)</label>
                <input type="text" name="totalAmount" />
            </li>
            <li>
                <label for="">기재상 '일련번호'항목</label>
                <input type="text" name="serialNum" />
            </li>
            <li>
                <label for="">기재상 '현금'항목</label>
                <input type="text" name="cash" />
            </li>
            <li>
                <label for="">기재상 '수표'항목</label>
                <input type="text" name="chkBill" />
            </li>
            <li>
                <label for="">기재상 '어음'항목</label>
                <input type="text" name="note" />
            </li>
            <li>
                <label for="">기재상 '외상'항목</label>
                <input type="text" name="credit" />
            </li>
            <li>
                <label for="">비고</label>
                <input type="text" name="remark1" />
                <p>{invoiceeType}이 "외국인" 이면 remark1 필수</p>
            </li>
            <li>
                <label for="">비고1</label>
                <input type="text" name="remark2" />
            </li>
            <li>
                <label for="">비고2</label>
                <input type="text" name="remark3" />
                <p>'비고3', // - 외국인 등록번호 또는 여권번호 입력</p>
            </li>
            <li>
                <label for="">기재상 '권' 항목, 최대값 32767</label>
                <input type="text" name="kwon" />
            </li>
            <li>
                <label for="">기재상 '호' 항목, 최대값 32767</label>
                <input type="text" name="ho" />
            </li>
            <li>
                <label for=""></label>
                <input type="text" name="" />
            </li>
            <li>
                <label for=""></label>
                <input type="text" name="" />
            </li>

        </ul>
    </fieldset>




    <button type="submit">임시작성</button>
</form>
