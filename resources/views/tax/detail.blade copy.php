<script src="https://cdn.tailwindcss.com"></script>


<h1>세금계산서</h1>
@if ($info->edited)
    <!-- Warning Alert -->
    <div class="p-4 md:p-5 rounded text-orange-700 bg-orange-100">
        <div class="flex items-center">
            <svg class="hi-solid hi-exclamation inline-block w-5 h-5 mr-3 flex-none text-orange-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            <h3 class="font-semibold grow">
                수정된 세금계산서 입니다.
            </h3>
        </div>
        <p>기본 입력된 사항은 시스템상 입력된 금액으로, 수정으로 인하여 발생하는 불이익은 책임지지 않습니다.</p>
    </div>
    <!-- END Warning Alert -->
@endif

{{--
@foreach ( $info as $item)
    <div>{{$item}}</div>
@endforeach
--}}




<h1>매출 문서작성</h1>
<div class="flex justify-between">
    <div>
        <div class="mt-2">
            <label class="inline-flex items-center">
                <span class="ml-2">과세형태</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio1" name="group_radio" checked>
                <span class="ml-2">과세(10%)</span>
            </label>
            <label class="inline-flex items-center ml-6">
                <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio2" name="group_radio">
                <span class="ml-2">영세(0%)</span>
            </label>
            <label class="inline-flex items-center ml-6">
                <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio2" name="group_radio">
                <span class="ml-2">면세(세액없음)</span>
            </label>
        </div>
    </div>
    <div>
        <div class="mt-2">
            <label class="inline-flex items-center">
                <span class="ml-2">거래처유형</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio1" name="group_radio" checked>
                <span class="ml-2">사업자)</span>
            </label>
            <label class="inline-flex items-center ml-6">
                <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio2" name="group_radio">
                <span class="ml-2">개인</span>
            </label>
            <label class="inline-flex items-center ml-6">
                <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio2" name="group_radio">
                <span class="ml-2">외국인</span>
            </label>
        </div>


    </div>
</div>

<div class="flex justify-between">
    <div>
        <h2>세금계산서</h2>
    </div>
    <div>
        <div>책번호: {}권 {}호</div>
        <div>일련번호:{}</div>
    </div>
</div>

<div class="flex">
    <div class="w-1/2 flex mr-16">
        <div class="w-8">공<br>급<br>자</div>
        <ul class="flex-grow">
            <li>
                <div class="space-y-1 md:space-y-0 md:flex md:items-center">
                    <label for="ttt1" class="font-medium md:w-1/3 flex-none md:mr-2">등록번호</label>
                    <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="text" id="ttt1" name="" placeholder="">
                </div>
            </li>
            <li>
                <div class="space-y-1 md:space-y-0 md:flex md:items-center">
                    <label for="ttt1" class="font-medium md:w-1/3 flex-none md:mr-2">종사업장</label>
                    <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="text" id="ttt1" name="" placeholder="">
                </div>
            </li>
            <li>
                <div class="space-y-1 md:space-y-0 md:flex md:items-center">
                    <label for="ttt1" class="font-medium md:w-1/3 flex-none md:mr-2">상호</label>
                    <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="text" id="ttt1" name="" placeholder="">
                </div>

            </li>
            <li>
                <div class="space-y-1 md:space-y-0 md:flex md:items-center">
                    <label for="ttt1" class="font-medium md:w-1/3 flex-none md:mr-2">성명</label>
                    <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="text" id="ttt1" name="" placeholder="">
                </div>

            </li>
            <li>
                <div class="space-y-1 md:space-y-0 md:flex md:items-center">
                    <label for="ttt1" class="font-medium md:w-1/3 flex-none md:mr-2">사업장주소</label>
                    <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="text" id="ttt1" name="" placeholder="">
                </div>

            </li>
            <li>
                <div class="space-y-1 md:space-y-0 md:flex md:items-center">
                    <label for="ttt1" class="font-medium md:w-1/3 flex-none md:mr-2">업태</label>
                    <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="text" id="ttt1" name="" placeholder="">
                </div>

            </li>
            <li>
                <div class="space-y-1 md:space-y-0 md:flex md:items-center">
                    <label for="ttt1" class="font-medium md:w-1/3 flex-none md:mr-2">종목</label>
                    <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="text" id="ttt1" name="" placeholder="">
                </div>

            </li>
            <li>
                <div class="space-y-1 md:space-y-0 md:flex md:items-center">
                    <label for="ttt1" class="font-medium md:w-1/3 flex-none md:mr-2">담당자</label>
                    <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="text" id="ttt1" name="" placeholder="">
                </div>

            </li>
            <li>
                <div class="space-y-1 md:space-y-0 md:flex md:items-center">
                    <label for="ttt1" class="font-medium md:w-1/3 flex-none md:mr-2">연락처</label>
                    <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="text" id="ttt1" name="" placeholder="">
                </div>

            </li>
            <li>
                <div class="space-y-1 md:space-y-0 md:flex md:items-center">
                    <label for="ttt1" class="font-medium md:w-1/3 flex-none md:mr-2">이메일</label>
                    <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="text" id="ttt1" name="" placeholder="">
                </div>

            </li>
        </ul>
    </div>
    <div class="w-1/2 flex">
        <div class="w-8">공<br>급<br>자<br>받<br>는<br>자</div>
        <ul class="flex-grow">
            <li>등록번호</li>
            <li>종사업장</li>
            <li>상호</li>
            <li>성명</li>
            <li>사업장주소</li>
            <li>업태</li>
            <li>종목</li>
            <li>담당자</li>
            <li>연락처</li>
            <li>이메일</li>
        </ul>
    </div>
</div>


<div>
    <ul>
        <li>작성일자</li>
        <li>공급가액</li>
        <li>세액</li>
        <li>비고1</li>
        <li>비고2</li>
        <li>비고3</li>
    </ul>
</div>

<div>
    작성방법
    <ul>
        <li>직접입력</li>
        <li>단가 부가세포함</li>
        <li>합계금액</li>
    </ul>
</div>

{{-- 물품정보 --}}
<table>
    <tr>
        <td>월</td>
        <td>일</td>
        <td>품목</td>
        <td>규격</td>
        <td>수량</td>
        <td>단가</td>
        <td>공급가액</td>
        <td>세액</td>
        <td>비고</td>
    </tr>
</table>

<div class="flex justify-between">

</div>
<div class="flex justify-between">
    <div>
        <ul>
            <li>합계금액</li>
            <li>현금</li>
            <li>수표</li>
            <li>어음</li>
            <li>외상미수금</li>
        </ul>
    </div>
    <div>
        <span>영수/청구/없음</span>
    </div>

</div>

<div class="flex justify-between">
    <div>
        <button class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">임시저장</button>
        <button class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">작성취소</button>
        <button class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">발행예정</button>
    </div>
    <div>
        <button type="button" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-red-700 bg-red-700 text-white hover:text-white hover:bg-red-800 hover:border-red-800 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:bg-red-700 active:border-red-700">
            발행
        </button>

    </div>
</div>





문자알림 서비스


<hr><hr>

<style>
    /* taxttype_area */

.taxinvoice_write { float:left; margin:10px 0 0 0; width:780px; }

#taxtype_area { float:left; width:780px; border-top:2px solid #a5a5a5; background-color:#fafafa; }
#taxtype_area .taxtype { float:left; }
#taxtype_area .taxtype .taxtype_radio { float:left; }
#taxtype_area .taxtype .taxtype_radio p { float:left; padding: 8px 25px 12px 25px; color:#555; }
#taxtype_area .taxtype .taxtype_radio span { float:left; padding: 7px 0 12px 0; }
#taxtype_area .taxtype .taxtype_radio span label { color:#555; }
#taxtype_area .taxtype .taxtype_radio label.for { curosr: pointer; padding-left: 3px;  }
#taxtype_area .taxtype .client_radio { float:left; margin: 0 0 0 31px; background:url(/images/taxinvoice/bg_taxinvoice_bar.gif) left 13px no-repeat; }
#taxtype_area .taxtype .client_radio p { float:left; padding: 8px 19px 12px 19px; color:#555; }
#taxtype_area .taxtype .client_radio span { float:left; padding: 7px 0 12px 0; margin: 0 0 0 45px; }
#taxtype_area .taxtype .client_radio span.mgl_46 { margin-left: 46px; }
#taxtype_area .taxtype .client_radio span label { color:#555; }
#taxtype_area .taxtype .client_radio label.for { curosr: pointer; padding-left: 3px; }
#taxTotalList .PT label.for { curosr: pointer; padding-left: 3px; }

.rad { width:13px; height:13px; margin-bottom:1px; vertical-align:middle; cursor:pointer; }
.PT .pt1 { float:left; margin: 16px 0 0 19%; }
.PT .pt2 { float:left; margin: 16px 0 0 12px; }
.PT .pt_s {float:left; margin:0 0 0 12px; }

.gray_border_t { border-top:1px solid #dfdfdf !important; }
.gray_border_b { border-bottom:1px solid #dfdfdf !important; }
.gray_border_l { border-left:1px solid #dfdfdf !important; }
.gray_border_r { border-right:1px solid #dfdfdf !important; }

.width100 { width:100%; }

.border_top_red { border-top: 2px solid #E66464 !important; }
#area_form textArea { overflow: hidden; }

#area_form { float:left; }
#area_form #etax_area_form { width: 776px;  padding:0px; }
#area_form #etax_area_form .etax_table { width:100%; border-spacing:0px 0px; }
#area_form #etax_area_form .etax_table th { font-weight:normal; padding-top:2px; padding-bottom:2px; line-height:15px; height:20px; }
#area_form #etax_area_form .etax_table th, x:-moz-any-link, x:default { height:25px;*height:20px; }
#area_form #etax_area_form .etax_table td { color:#333333; padding-top:1px; padding-bottom:3px; height:20px; }
#area_form #etax_area_form .etax_table td input.in_txt { margin:2px 0px 0px 0px; }
#area_form #etax_area_form .etax_table td textarea { float:left; margin:2px 0px 0px 0px; resize:none; }
#area_form #etax_area_form .etax_table td, x:-moz-any-link, x:default { height:25px;*height:20px; }
#area_form #etax_area_form .table_border_red th { color:#e62324; }
#area_form #etax_area_form .table_border_blue th { color:#3070ad; }
#etax_area_form .table_border_red tbody th { border-top:1px solid #f58c8c; border-left:1px solid #f58c8c; }
#etax_area_form .table_border_red tbody th.invoicer_bg { background-color:#fff6f6; }
#etax_area_form .table_border_red tbody td { border-top:1px solid #f58c8c; border-left:1px solid #f58c8c; }
#etax_area_form .table_border_red .underline { border-bottom:1px solid #f58c8c; }
#etax_area_form .table_border_red tbody th.splitline { padding:0 0 0 0 !important; height: 0 !important; }
#etax_area_form .table_border_blue tbody th { border-top:1px solid #5b9adf; border-left:1px solid #5b9adf; }
#etax_area_form .table_border_blue tbody th.invoicer_bg { background-color:#f0f6fd; }
#etax_area_form .table_border_blue tbody td { border-top:1px solid #5b9adf; border-left:1px solid #5b9adf; }
#etax_area_form .table_border_blue .underline { border-bottom:1px solid #5b9adf; }
#etax_area_form .table_border_blue tbody th.splitline { padding:0 0 0 0 !important; height: 0 !important; }


#area_form #etax_area_form .etax_table .invoicer_border { border-top:1px solid #f58c8c; border-left:1px solid #f58c8c; color:#e62324; }
#area_form #etax_area_form .etax_table th.invoicer_border { color:#e62324; }
#area_form #etax_area_form .etax_table th.invoicee_border { color:#3070ad; }
#area_form #etax_area_form .etax_table .invoicee_border { border-top:1px solid #5b9adf; border-left:1px solid #5b9adf; }
#area_form #etax_area_form .etax_table .invoicee_t_none { border-top:none; }
#area_form #etax_area_form .etax_table .invoicee_l_none { border-left:none; }
#area_form #etax_area_form .etax_table .item_border { border-top:1px solid #dfdfdf; border-left:1px solid #dfdfdf; }
#area_form #etax_area_form .etax_table .item_l_border { border-left:1px solid #dfdfdf; }
#area_form #etax_area_form .etax_table .item_t_border { border-top:1px solid #dfdfdf; }

#area_form #etax_area_form #tax_button.invoicer_border { height:38px; padding: 13px 15px 9px 15px; border-top:1px solid #f58c8c; }
#area_form #etax_area_form #tax_button.invoicee_border { height:38px; padding: 13px 15px 9px 15px; border-top:1px solid #5b9adf; }

.gray_bg { background-color:#f1f3f6; }

.invoicee_blue { color:#0071c9; }

.autoDeal { margin: 0 18px 0 0; }


ul.modify_step { float:left; width:780px; margin:9px 0 40px 0; }
ul.modify_step li { float:left; height:49px; border-top:1px solid #dfdfdf; border-bottom:3px solid #808080; }
ul.modify_step li span.num { float:left; margin:13px 0 0  18px; font-size:25px; font-weight:bold; color:#cdcdcd; }
ul.modify_step li span.text { float:left; margin:13px 0 0 12px; font-size:15px; color:#777; }
ul.modify_step li.step_on { width:198px; height: 53px; padding: 0 0 0 55px; border-top:5px solid #276cc7; border-left:3px solid #276cc7; border-right:3px solid #276cc7; border-bottom:none; }
ul.modify_step li.step_on span.num { float:left; margin:13px 0 0 0; font-size:26px; font-weight:bold; color:#ff4747; line-height:26px; }
ul.modify_step li.step_on span.text { float:left; margin:12px 0 0 13px; font-size:20px; font-weight:bold; color:#000; line-height:26px; }
ul.modify_step li.step_off_l { width:207px; margin:5px 0 0 0; padding:0 0 0 53px; border-left:1px solid #dfdfdf; }
ul.modify_step li.step_off_r { width:209px; margin:5px 0 0 0; padding:0 0 0 50px; border-right:1px solid #dfdfdf; }
ul.modify_step li.width_206 { width:206px; }

#modify_select_panel {  float:left; width:100%; margin:0 0 0 0;  cursor: pointer; }
#modify_select_panel li.modify_01 { position:relative; float:left; width: 385px; height:137px; padding: 2px; border-left: 1px solid #d0d0d0; border-top: 1px solid #d0d0d0; }
#modify_select_panel li.modify_01:hover { border-top:1px solid #ff4747; border-left:1px solid #ff4747; }
#modify_select_panel li.modify_01:hover + li { border-left:1px solid #ff4747;}
#modify_select_panel li.modify_01:hover + li + li { border-top:1px solid #ff4747;}
#modify_select_panel li.modify_01.select { width:384px; height:136px; padding:0px; border:3px solid #ff4747 !important; }
#modify_select_panel li.modify_02 { position:relative; float:left; width: 384px; height:137px; padding: 2px; border-left: 1px solid #d0d0d0; border-top: 1px solid #d0d0d0; border-right: 1px solid #d0d0d0; }
#modify_select_panel li.modify_02:hover { border-top:1px solid #ff4747; border-left:1px solid #ff4747; border-right:1px solid #ff4747; }
#modify_select_panel li.modify_02:hover + li + li { border-top:1px solid #ff4747;}
#modify_select_panel li.modify_02.select { width:384px; height:136px; padding:0px; border:3px solid #ff4747 !important; }
#modify_select_panel li.modify_03 { position:relative; float:left; width: 385px; height:137px; padding: 2px; border-left: 1px solid #d0d0d0; border-top: 1px solid #d0d0d0; }
#modify_select_panel li.modify_03:hover { border-top:1px solid #ff4747; border-left:1px solid #ff4747; }
#modify_select_panel li.modify_03:hover + li { border-left:1px solid #ff4747;}
#modify_select_panel li.modify_03:hover + li + li { border-top:1px solid #ff4747;}
#modify_select_panel li.modify_03.select { width:384px; height:136px; padding:0px; border:3px solid #ff4747 !important; }
#modify_select_panel li.modify_04 { position:relative; float:left; width: 384px; height:137px; padding: 2px; border-left: 1px solid #d0d0d0; border-top: 1px solid #d0d0d0; border-right: 1px solid #d0d0d0; }
#modify_select_panel li.modify_04:hover { border-top:1px solid #ff4747; border-left:1px solid #ff4747; border-right:1px solid #ff4747; }
#modify_select_panel li.modify_04:hover + li + li { border-top:1px solid #ff4747;}
#modify_select_panel li.modify_04.select { width:384px; height:136px; padding:0px; border:3px solid #ff4747 !important; }
#modify_select_panel li.modify_05 { position:relative; float:left; width: 385px; height:137px; padding: 2px; border-left: 1px solid #d0d0d0; border-top: 1px solid #d0d0d0; border-bottom: 1px solid #d0d0d0; }
#modify_select_panel li.modify_05:hover { border-top:1px solid #ff4747; border-left:1px solid #ff4747; border-bottom:1px solid #ff4747; }
#modify_select_panel li.modify_05:hover + li { border-left:1px solid #ff4747;}
#modify_select_panel li.modify_05.select { width:384px; height:136px; padding:0px; border:3px solid #ff4747 !important; }
#modify_select_panel li.modify_06 { position:relative; float:left; width: 384px; height:137px; padding: 2px; border: 1px solid #d0d0d0; }
#modify_select_panel li.modify_06:hover { border:1px solid #ff4747; }
#modify_select_panel li.modify_06.select { width:384px; height:136px; padding:0px; border:3px solid #ff4747 !important; }
#modify_select_panel li.modify_06_off { position:relative; float:left; width: 384px; height:137px; padding: 2px; border: 1px solid #d0d0d0; background-color:#f6f6f6; }


#modify_select_panel li p.bg_img {position:absolute; top:100px; left:306px; margin:0 !important; padding:0; }

#modify_select_panel li.modify_01:hover dl dt { margin:1px 0 0 34px; font-size:17px; color:#e62324; }
#modify_select_panel li.modify_01:hover dl dd { margin:11px 0 0 33px; }
#modify_select_panel li.modify_02:hover dl dt { margin:1px 0 0 34px; font-size:17px; color:#e62324; }
#modify_select_panel li.modify_02:hover dl dd { margin:11px 0 0 33px; }
#modify_select_panel li.modify_03:hover dl dt { margin:1px 0 0 34px; font-size:17px; color:#e62324; }
#modify_select_panel li.modify_03:hover dl dd { margin:11px 0 0 33px; }
#modify_select_panel li.modify_04:hover dl dt { margin:1px 0 0 34px; font-size:17px; color:#e62324; }
#modify_select_panel li.modify_04:hover dl dd { margin:11px 0 0 33px; }
#modify_select_panel li.modify_05:hover dl dt { margin:1px 0 0 34px; font-size:17px; color:#e62324; }
#modify_select_panel li.modify_05:hover dl dd { margin:11px 0 0 33px; }
#modify_select_panel li.modify_06:hover dl dt { margin:1px 0 0 34px; font-size:17px; color:#e62324; }
#modify_select_panel li.modify_06:hover dl dd { margin:11px 0 0 33px; }

#modify_select_panel li dl { padding: 14px 50px 13px 26px; background:url('/images/common/write/icon_select_off.gif') 26px 16px no-repeat; }
#modify_select_panel li dl dt { margin: 3px 0 0 34px; font-size:15px; font-weight:bold; color:#333; }
#modify_select_panel li dl dd { margin: 9px 0 0 33px; font-size:13px; color:#777; }
#modify_select_panel li p { margin: 0 0 0 61px;  }
#modify_select_panel li p a { text-decoration:underline; background:url('/images/common/write/dot_01.gif') right center no-repeat; }
#modify_select_panel li.modify_05 p { margin:19px 0 0 61px; }
#modify_select_panel li.modify_06 p { margin:19px 0 0 61px; }
#modify_select_panel li.modify_06_off p { margin:19px 0 0 61px; }

#modify_select_panel li.select dl { padding: 14px 50px 13px 26px; background:url('/images/common/write/icon_select_on.gif') 26px 16px no-repeat; }
#modify_select_panel li.select dl dt { margin:1px 0 0 34px; font-size:17px; color:#e62324; }
#modify_select_panel li.select dl dd { margin:11px 0 0 33px; }

#modify_select_panel li.modify_06_off dl  { padding: 14px 50px 13px 26px; background:url('/images/common/write/icon_select_no.gif') 26px 16px no-repeat; }
#modify_select_panel li.modify_06_off dl dt { margin: 3px 0 0 34px; font-size:15px; font-weight:bold; color:#888; }
#modify_select_panel li.modify_06_off dl dd { margin: 9px 0 0 33px; font-size:13px; color:#999; }

#AddSendEmail .contact_bg { background:url('/images/common/sendemail_contact.gif') 1px 3px no-repeat #fff; }
#AddSendEmail .email_bg { background:url('/images/common/sendemail_email.gif') 1px 3px no-repeat #fff; }

#siteMgtKeyInputArea { float: left; width: 780px; height: 39px; background: #f1f3f6; text-align: center; }

#siteMgtKeyInputArea > div.default_aside { display: inline-block; }

#siteMgtKeyInputArea > div > p { display: inline-block; line-height: 38px; color: #e62324; font-weight: bold; font-size: 12px; }
#siteMgtKeyInputArea > div > input { display: inline-block; width: 200px; height: 20px; margin: 0px; border: 1px solid #cacaca; background-color: #FFFFFF; color: #333333; padding: 0 2px 2px 2px; vertical-align: middle; font-size: 12px; font-family: Malgun Gothic, 맑은 고딕, Apple SD Gothic Neo; margin: 0 0 0 3px;  }
#siteMgtKeyInputArea > div > input.readonly { background: #EAEAEA; }
#siteMgtKeyInputArea > div > p.sale{ }
#siteMgtKeyInputArea > div > p.buy{ color: #3070ad; }
</style>

<div id="area_form">
    <div id="etax_area_form" class="border_red">
        <table class="etax_table table_border_red" summary="세금계산서">
            <thead>
                <tr>
                    <th class="al_c" colspan="46" rowspan="2">

                    <span class="ft_24 bold" id="taxName">세금계산서</span>
                    </th>
                    <th class="al_c" colspan="12" rowspan="2"><span>공 급 자</span><br>(보 관 용)</th>
                    <td colspan="6" rowspan="2"></td>
                    <th class="al_r pdr_3" colspan="10">책번호 : </th>
                    <td class="al_l pdl_3" colspan="10"><input class="in_txt numeric" maxlength="4" style="width:63px;" tabindex="1" type="text" id="Kwon" name="Kwon" value=""></td>
                    <th class="al_l" colspan="4">권</th>
                    <td class="al_l pdl_3" colspan="10"><input class="in_txt numeric" maxlength="4" style="width:63px;" tabindex="2" type="text" id="Ho" name="Ho" value=""></td>
                    <th class="al_l" colspan="2">호</th>
                </tr>
            <tr>
                <th class="al_r pdr_3" colspan="10">일련번호 : </th>
                <td class="al_l pdl_3" colspan="26"><input class="in_txt" maxlength="27" style="width:172px;margin:0px;" tabindex="3" type="text" id="SerialNum" name="SerialNum" value=""></td>
            </tr>
            </thead>
            <tbody id="InvoiceList">
                <tr>
                    <th class="splitline noborder_t" colspan="50"></th>
                    <th class="splitline noborder_t" colspan="50"></th>
                </tr>
                <tr>
                    <th class="al_c invoicer_bg noborder_l" colspan="3" rowspan="6"><span class="bold lh_30">공<br>급<br>자</span></th>
                    <th class="al_c bold" colspan="8">등록번호</th>
                    <td class="al_l pdl_3" colspan="23"><input class="in_txt numeric al_c letspc_0 readonly" maxlength="12" tabindex="4" type="text" style="width:95%" id="InvoicerCorpNum" name="InvoicerCorpNum" value="858-81-01858" readonly="readonly"></td>

                    <th class="al_c" colspan="8">종사업장</th>
                    <td class="al_l pdl_3" colspan="8"><input class="in_txt numeric letspc_0" maxlength="4" style="width:85%" tabindex="5" type="text" id="InvoicerTaxRegID" name="InvoicerTaxRegID" value=""></td>

                    <th class="al_c  invoicer_bg" colspan="3" rowspan="6"><span class="bold lh_16">공<br>급<br>받<br>는<br>자</span></th>
                    <th class="al_c bold" colspan="8">등록번호</th>
                    <td class="al_l pdl_3" colspan="23"><input class="in_txt numeric al_c letspc_0" maxlength="12" tabindex="14" type="text" style="width:134px" id="InvoiceeCorpNum" name="InvoiceeCorpNum" value=""><button class="btn_white_gradient mgl_2" id="btnSelectInvoicee" style="margin-top:2px;height:20px;" type="button">선택</button></td>

                    <th class="al_c" colspan="8">종사업장</th>
                    <td class="al_l pdl_3" colspan="8"><input class="in_txt numeric letspc_0" maxlength="4" style="width:85%;" tabindex="15" type="text" id="InvoiceeTaxRegID" name="InvoiceeTaxRegID" value=""></td>
                </tr>
                <tr>
                    <th class="al_c bold" colspan="8"><span>상</span><span class="mgl_20">호</span></th>
                    <td class="al_l pdl_3" colspan="23"><textarea class="txt_ar kr" maxlength="200" style="width:95%; height:27px;" tabindex="6" id="InvoicerCorpName" name="InvoicerCorpName">퀀텀리프(주)</textarea></td>
                    <th class="al_c bold lh_14" colspan="4"><p>성</p><p>명</p></th>
                    <td class="al_l pdl_3" colspan="12"><textarea class="txt_ar kr" maxlength="100" style="width:90%; height:27px;" tabindex="7" id="InvoicerCEOName" name="InvoicerCEOName">김경환</textarea></td>
                    <th class="al_c bold" colspan="8"><span>상</span><span class="mgl_20">호</span></th>
                    <td class="al_l pdl_3" colspan="23"><textarea class="txt_ar kr" maxlength="200" style="width:95%; height:27px;" tabindex="16" id="InvoiceeCorpName" name="InvoiceeCorpName"></textarea></td>
                    <th class="al_c bold lh_14" colspan="4">성<br>명</th>
                    <td class="al_l pdl_3" colspan="12"><textarea class="txt_ar kr" maxlength="100" style="width:90%; height:27px;" tabindex="17" id="InvoiceeCEOName" name="InvoiceeCEOName"></textarea></td>
                </tr>
                <tr>
                    <th class="al_c  lh_14" colspan="8"><p><span>사</span><span class="mgl_4">업</span><span class="mgl_4">장</span></p><p><span>주</span><span class="mgl_20">소</span></p></th>
                    <td class="al_l pdl_3" colspan="39"><textarea class="txt_ar kr" maxlength="300" style="width:97%; height:27px;" tabindex="8" id="InvoicerAddr" name="InvoicerAddr">서울특별시 송파구 법원로 114, C동 304호 305호 (문정동, 엠스테이트)</textarea></td>
                    <th class="al_c lh_14" colspan="8"><p><span>사</span><span class="mgl_4">업</span><span class="mgl_4">장</span></p><p><span>주</span><span class="mgl_20">소</span></p></th>
                    <td class="al_l pdl_3" colspan="39"><textarea class="txt_ar kr" maxlength="300" style="width:97%; height:27px;" tabindex="18" id="InvoiceeAddr" name="InvoiceeAddr"></textarea></td>
                </tr>
                <tr>
                    <th class="al_c" colspan="8"><span>업</span><span class="mgl_20">태</span></th>
                    <td class="al_l pdl_3" colspan="17"><textarea class="txt_ar kr" maxlength="100" style="width:94%; height:27px;" tabindex="9" id="InvoicerBizType" name="InvoicerBizType">정보통신업</textarea></td>
                    <th class="al_c lh_14" colspan="4"><p>종</p><p>목</p></th>
                    <td class="al_l pdl_3" colspan="18"><textarea class="txt_ar kr" maxlength="100" style="width:93%; height:27px;" tabindex="10" id="InvoicerBizClass" name="InvoicerBizClass">프로그램개발및공급</textarea></td>
                    <th class="al_c" colspan="8"><span>업</span><span class="mgl_20">태</span></th>
                    <td class="al_l pdl_3" colspan="17"><textarea class="txt_ar kr" maxlength="100" style="width:94%; height:27px;" tabindex="19" id="InvoiceeBizType" name="InvoiceeBizType"></textarea></td>
                    <th class="al_c lh_14" colspan="4"><p>종</p><p>목</p></th>
                    <td class="al_l pdl_3" colspan="18"><textarea class="txt_ar kr" maxlength="100" style="width:93%; height:27px;" tabindex="20" id="InvoiceeBizClass" name="InvoiceeBizClass"></textarea></td>
                </tr>
                <tr>
                    <th class="al_c" colspan="8"><span>담</span><span class="mgl_4">당</span><span class="mgl_4">자</span></th>
                    <td class="al_l pdl_3" colspan="17"><input class="in_txt kr" maxlength="100" style="width:94%;" tabindex="11" type="text" id="InvoicerContactName" name="InvoicerContactName" value="권바울"></td>
                    <th class="al_c" colspan="6">연락처</th>
                    <td class="al_l pdl_3" colspan="16"><input class="in_txt numeric" maxlength="20" style="width:92%;" tabindex="12" type="text" id="InvoicerTEL" name="InvoicerTEL" value="010-4125-4593"></td>
                    <th class="al_c" colspan="8"><span>담</span><span class="mgl_4">당</span><span class="mgl_4">자</span></th>
                    <td class="al_l pdl_3" colspan="17"><input class="in_txt kr" maxlength="100" style="width:94%;" tabindex="21" type="text" id="InvoiceeContactName1" name="InvoiceeContactName1" value=""></td>
                    <th class="al_c" colspan="6">연락처</th>
                    <td class="al_l pdl_3" colspan="16"><input class="in_txt numeric" maxlength="20" style="width:92%;" tabindex="22" type="text" id="InvoiceeTEL1" name="InvoiceeTEL1" value=""></td>
                </tr>
                <tr>
                    <th class="al_c" colspan="8"><span>이</span><span class="mgl_4">메</span><span class="mgl_4">일</span></th>
                    <td class="al_l pdl_3" colspan="39"><input class="in_txt en" maxlength="100" style="width:97%;" tabindex="13" type="text" id="InvoicerEmail" name="InvoicerEmail" value="paul.jlove@quantumleap.co.kr"></td>

                    <th class="al_c" colspan="8"><span>이</span><span class="mgl_4">메</span><span class="mgl_4">일</span></th>

                    <td class="al_l pdl_3" colspan="39"><input class="in_txt en" maxlength="100" style="width:66%;" tabindex="23" type="text" id="InvoiceeEmail1" name="InvoiceeEmail1" value="">&nbsp;<a class="btn_white_gradient pdl_5 pdr_5 mgt_2 lh_17" id="SaveInvoiceeClientInfo"><img alt="주소록에저장" src="/images/common/write/icon_save.gif">&nbsp;주소록에 저장</a></td>
                </tr>
            </tbody>


            <!-- <tbody th:if="${IssueType} == '위수탁'" id="TrustList">
                <tr>
                    <th colspan="50" class="splitline noborder_t"></th>
                    <th colspan="50" class="splitline noborder_t"></th>
                </tr>
                <tr>
                    <th colspan="11" class="al_c noborder_l"><span class="bold">수탁자</span></th>
                    <td colspan="89" class="pdl_3 pdr_3">
                        <span th:text="${taxinvoiceInfo.TrusteeCorpName}"></span>&nbsp;(<span class="letspc_0" th:text="${SiteUtil.FormatCorpNum(taxinvoiceInfo.TrusteeCorpNum)}"></span>,&nbsp;종사업장:<input type="text" th:field="*{TrusteeTaxRegID}" class="in_txt numeric" style="width:31px;" maxlength="4" tabindex="24" />) , <span th:text="${taxinvoiceInfo.TrusteeCEOName}"></span> , <span th:text="${taxinvoiceInfo.TrusteeBizType}"></span>  / <span th:text="${taxinvoiceInfo.TrusteeBizClass}"></span>
                        <input type="hidden" name="TrusteeCorpNum" th:field="*{TrusteeCorpNum}" />
                        <input type="hidden" th:field="*{TrusteeCorpName}" />
                        <input type="hidden" th:field="*{TrusteeCEOName}" />
                        <input type="hidden" th:field="*{TrusteeAddr}" />
                        <input type="hidden" th:field="*{TrusteeBizType}" />
                        <input type="hidden" th:field="*{TrusteeBizClass}" />
                        <input type="hidden" th:field="*{TrusteeContactName}" />
                        <input type="hidden" th:field="*{TrusteeTEL}" />
                        <input type="hidden" th:field="*{TrusteeEmail}" />
                    </td>
                </tr>
            </tbody> -->
            <tbody id="TotalList">
            <tr>
                    <th class="splitline noborder_t" colspan="50"></th>
                    <th class="splitline noborder_t" colspan="50"></th>
                </tr>
                <tr>
                    <th class="al_c noborder_l" colspan="11"><span class="bold">작성일자</span>&nbsp;<img class="hand val_m" id="WriteDateImg" onblur="date_recover($('#WriteDate'))" onclick="$('#WriteDate').dpDisplay(); date_replace($('#WriteDate')); return false;" src="/images/common/table/icon_calendar.gif"></th>
                    <th class="al_c pet0 gray_border_l" colspan="47"><span class="bold">공급가액</span></th>
                    <th class="al_c pet1 gray_border_l" colspan="42"><span class="bold">세&nbsp;&nbsp;&nbsp;&nbsp;액</span></th>
                </tr>
                <tr>
                    <td class="al_c noborder_l gray_border_t" colspan="11"><input class="in_txt numeric al_c dtpicker dp-applied" maxlength="10" onblur="date_recover(this)" onclick="date_replace(this); $('#WriteDate').dpDisplay();" style="width:85%; font-size:12px !important" tabindex="34" type="text" id="WriteDate" name="WriteDate" value="2022-07-20"></td>
                    <td class="al_l pet0 pdl_3 gray_border_t gray_border_l" colspan="47"><input class="in_txt readonly al_r" maxlength="22" readonly="readonly" style="width: 352px;" type="text" id="SupplyCostTotal" name="SupplyCostTotal" value=""></td>
                    <td class="al_l pet1 pdl_3 gray_border_t gray_border_l" colspan="42"><input class="in_txt readonly al_r" maxlength="22" readonly="readonly" style="width:97%;" type="text" id="TaxTotal" name="TaxTotal" value=""></td>
                </tr>
            </tbody>
            <tbody id="remarkList">
                <tr>
                    <th class="splitline noborder_t" colspan="50"></th>
                    <th class="splitline noborder_t" colspan="50"></th>
                </tr>
                <tr>
                    <th class="al_c noborder_l" colspan="11"><span class="bold">비고1</span></th>
                    <td class="al_l pdl_3 gray_border_l" colspan="85"><input class="in_txt kr" maxlength="150" style="width:646px;" tabindex="35" type="text" id="Remark1" name="Remark1" value=""></td>
                    <td class="al_c item_l_border gray_border_l" colspan="4">
                        <button id="addRemark" type="button"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_add.gif"></button>
                    </td>
                </tr>
                <tr id="remark2" class="none">
                    <th class="al_c noborder_l gray_border_t" colspan="11"><span class="bold">비고2</span></th>
                    <td class="al_l pdl_3 gray_border_l gray_border_t" colspan="85"><input class="in_txt kr" maxlength="150" style="width:646px;" tabindex="36" type="text" id="Remark2" name="Remark2" value=""></td>
                    <td class="al_c item_l_border gray_border_l gray_border_t" colspan="4">
                        <button id="removeRemark2" type="button"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_del.gif"></button>
                    </td>
                </tr>
                <tr id="remark3" class="none">
                    <th class="al_c noborder_l gray_border_t" colspan="11"><span class="bold">비고3</span></th>
                    <td class="al_l pdl_3 gray_border_l gray_border_t" colspan="85"><input class="in_txt kr" maxlength="150" style="width:646px;" tabindex="37" type="text" id="Remark3" name="Remark3" value=""></td>
                    <td class="al_c item_l_border gray_border_l gray_border_t" colspan="4">
                        <button id="removeRemark3" type="button"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_del.gif"></button>
                    </td>
                </tr>
            </tbody>
            <tbody id="WriteTypeList">
                <tr>
                    <th class="splitline noborder_t" colspan="50"></th>
                    <th class="splitline noborder_t" colspan="50"></th>
                </tr>
                <tr>
                    <th class="gray_bg al_c noborder_l" colspan="11"><span class="bold">작성방법</span></th>
                    <td class="gray_bg gray_border_l" colspan="89">
                        <span class="pdl_10"><input checked="checked" class="rad" id="WriteType1" name="WriteType" tabindex="38" type="radio" value="직접입력"><label class="for" for="WriteType1">직접입력</label></span>
                        <span class="pdl_39"><input class="rad" id="WriteType2" name="WriteType" tabindex="29" type="radio" value="수량단가"><label class="for" for="WriteType2" id="WCostVAT">단가 부가세포함</label></span>

                        <span class="pdl_39 sm" id="lblWriteType">
                            <input class="rad" id="WriteType4" name="WriteType" tabindex="40" type="radio" value="합계금액"><label class="for" for="WriteType4">합계금액</label>&nbsp;&nbsp;<button class="btn_white_gradient" id="totalAmountAct" type="button">계산</button>
                        </span>

                    </td>
                </tr>
                <tr>
                    <th class="splitline noborder_t" colspan="50"></th>
                    <th class="splitline noborder_t" colspan="50"></th>
                </tr>
            </tbody>
            <tbody id="taxList">

                <tr>
                    <th class="al_c noborder_l" colspan="4"><span class="bold">월</span></th>
                    <th class="al_c item_l_border" colspan="4"><span class="bold">일</span></th>
                    <th class="al_c item_l_border" colspan="24"><span class="bold">품&nbsp;&nbsp;목</span></th>
                    <th class="al_c item_l_border" colspan="14"><span class="bold">규&nbsp;&nbsp;격</span></th>
                    <th class="al_c pet2 item_l_border" colspan="8"><span class="bold">수&nbsp;&nbsp;량</span></th>
                    <th class="al_c pet3 item_l_border" colspan="8"><span class="bold">단&nbsp;&nbsp;가</span></th>
                    <th class="al_c pet4 item_l_border" colspan="12"><span class="bold">공급가액</span></th>
                    <th class="al_c pet5 item_l_border" colspan="10"><span class="bold">세&nbsp;&nbsp;액</span></th>
                    <th class="al_c item_l_border" colspan="12"><span class="bold">비&nbsp;&nbsp;고</span></th>
                    <th class="al_c item_l_border" colspan="4"><button id="btnAddFiveDetails" type="button"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_add.gif"></button></th>
                </tr>
                <tr id="item_0">
                    <td class="al_l pdl_3 noborder_l item_t_border" colspan="4">
                        <input type="hidden" id="detailList0.SerialNum" name="detailList[0].SerialNum" value="1">
                        <input type="hidden" id="detailList0.PurchaseDT" name="detailList[0].PurchaseDT" value="">
                        <input class="in_txt numeric al_c in_detail" maxlength="2" style="width:67%; height:25px;" tabindex="50" type="text" id="detailList0.PurchaseDT1" value="">
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="4">
                        <input class="in_txt numeric al_c in_detail" maxlength="2" style="width:67%; height:25px;" tabindex="50" type="text" id="detailList0.PurchaseDT2" value="">
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="24">
                        <textarea class="txt_ar" maxlength="100" style="width:81%; height:25px;" tabindex="50" id="detailList0.ItemName" name="detailList[0].ItemName"></textarea><button class="mgt_3 mgl_3" type="button" id="btnViewItem_0"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_search.gif"></button>
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="14"><textarea class="txt_ar" maxlength="60" style="width:91%; height:25px;" tabindex="50" id="detailList0.Spec" name="detailList[0].Spec"></textarea></td>
                    <td class="al_l pdl_3 item_border pet2" colspan="8"><input class="in_txt numeric number al_r in_detail" maxlength="16" style="width:85%; height:25px;" tabindex="50" type="text" id="detailList0.Qty" name="detailList[0].Qty" value=""></td>
                    <td class="al_l pdl_3 item_border pet3" colspan="8"><input class="in_txt numeric number al_r in_detail" maxlength="22" style="width:85%; height:25px;" tabindex="50" type="text" id="detailList0.UnitCost" name="detailList[0].UnitCost" value=""></td>
                    <td class="al_l pdl_3 item_border pet4" colspan="12"><input class="in_txt numeric money al_r in_detail" maxlength="22" style="width:89%; height:25px;" tabindex="50" type="text" id="detailList0.SupplyCost" name="detailList[0].SupplyCost" value=""></td>
                    <td class="al_l pdl_3 item_border pet5" colspan="10"><input class="in_txt numeric money al_r in_detail" maxlength="22" style="width:89%; height:25px;" tabindex="50" type="text" id="detailList0.Tax" name="detailList[0].Tax" value=""></td>
                    <td class="al_l pdl_3 item_border" colspan="12"><textarea class="txt_ar" maxlength="100" style="width:89%; height:25px;" tabindex="50" id="detailList0.Remark" name="detailList[0].Remark"></textarea></td>
                    <td class="al_c item_border" colspan="4"><button type="button" id="btnDelItem_0"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_del.gif"></button></td>
                </tr>
                <tr id="item_1">
                    <td class="al_l pdl_3 noborder_l item_t_border" colspan="4">
                        <input type="hidden" id="detailList1.SerialNum" name="detailList[1].SerialNum" value="2">
                        <input type="hidden" id="detailList1.PurchaseDT" name="detailList[1].PurchaseDT" value="">
                        <input class="in_txt numeric al_c in_detail" maxlength="2" style="width:67%; height:25px;" tabindex="50" type="text" id="detailList1.PurchaseDT1" value="">
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="4">
                        <input class="in_txt numeric al_c in_detail" maxlength="2" style="width:67%; height:25px;" tabindex="50" type="text" id="detailList1.PurchaseDT2" value="">
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="24">
                        <textarea class="txt_ar" maxlength="100" style="width:81%; height:25px;" tabindex="50" id="detailList1.ItemName" name="detailList[1].ItemName"></textarea><button class="mgt_3 mgl_3" type="button" id="btnViewItem_1"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_search.gif"></button>
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="14"><textarea class="txt_ar" maxlength="60" style="width:91%; height:25px;" tabindex="50" id="detailList1.Spec" name="detailList[1].Spec"></textarea></td>
                    <td class="al_l pdl_3 item_border pet2" colspan="8"><input class="in_txt numeric number al_r in_detail" maxlength="16" style="width:85%; height:25px;" tabindex="50" type="text" id="detailList1.Qty" name="detailList[1].Qty" value=""></td>
                    <td class="al_l pdl_3 item_border pet3" colspan="8"><input class="in_txt numeric number al_r in_detail" maxlength="22" style="width:85%; height:25px;" tabindex="50" type="text" id="detailList1.UnitCost" name="detailList[1].UnitCost" value=""></td>
                    <td class="al_l pdl_3 item_border pet4" colspan="12"><input class="in_txt numeric money al_r in_detail" maxlength="22" style="width:89%; height:25px;" tabindex="50" type="text" id="detailList1.SupplyCost" name="detailList[1].SupplyCost" value=""></td>
                    <td class="al_l pdl_3 item_border pet5" colspan="10"><input class="in_txt numeric money al_r in_detail" maxlength="22" style="width:89%; height:25px;" tabindex="50" type="text" id="detailList1.Tax" name="detailList[1].Tax" value=""></td>
                    <td class="al_l pdl_3 item_border" colspan="12"><textarea class="txt_ar" maxlength="100" style="width:89%; height:25px;" tabindex="50" id="detailList1.Remark" name="detailList[1].Remark"></textarea></td>
                    <td class="al_c item_border" colspan="4"><button type="button" id="btnDelItem_1"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_del.gif"></button></td>
                </tr>
                <tr id="item_2">
                    <td class="al_l pdl_3 noborder_l item_t_border" colspan="4">
                        <input type="hidden" id="detailList2.SerialNum" name="detailList[2].SerialNum" value="3">
                        <input type="hidden" id="detailList2.PurchaseDT" name="detailList[2].PurchaseDT" value="">
                        <input class="in_txt numeric al_c in_detail" maxlength="2" style="width:67%; height:25px;" tabindex="50" type="text" id="detailList2.PurchaseDT1" value="">
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="4">
                        <input class="in_txt numeric al_c in_detail" maxlength="2" style="width:67%; height:25px;" tabindex="50" type="text" id="detailList2.PurchaseDT2" value="">
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="24">
                        <textarea class="txt_ar" maxlength="100" style="width:81%; height:25px;" tabindex="50" id="detailList2.ItemName" name="detailList[2].ItemName"></textarea><button class="mgt_3 mgl_3" type="button" id="btnViewItem_2"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_search.gif"></button>
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="14"><textarea class="txt_ar" maxlength="60" style="width:91%; height:25px;" tabindex="50" id="detailList2.Spec" name="detailList[2].Spec"></textarea></td>
                    <td class="al_l pdl_3 item_border pet2" colspan="8"><input class="in_txt numeric number al_r in_detail" maxlength="16" style="width:85%; height:25px;" tabindex="50" type="text" id="detailList2.Qty" name="detailList[2].Qty" value=""></td>
                    <td class="al_l pdl_3 item_border pet3" colspan="8"><input class="in_txt numeric number al_r in_detail" maxlength="22" style="width:85%; height:25px;" tabindex="50" type="text" id="detailList2.UnitCost" name="detailList[2].UnitCost" value=""></td>
                    <td class="al_l pdl_3 item_border pet4" colspan="12"><input class="in_txt numeric money al_r in_detail" maxlength="22" style="width:89%; height:25px;" tabindex="50" type="text" id="detailList2.SupplyCost" name="detailList[2].SupplyCost" value=""></td>
                    <td class="al_l pdl_3 item_border pet5" colspan="10"><input class="in_txt numeric money al_r in_detail" maxlength="22" style="width:89%; height:25px;" tabindex="50" type="text" id="detailList2.Tax" name="detailList[2].Tax" value=""></td>
                    <td class="al_l pdl_3 item_border" colspan="12"><textarea class="txt_ar" maxlength="100" style="width:89%; height:25px;" tabindex="50" id="detailList2.Remark" name="detailList[2].Remark"></textarea></td>
                    <td class="al_c item_border" colspan="4"><button type="button" id="btnDelItem_2"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_del.gif"></button></td>
                </tr>
                <tr id="item_3">
                    <td class="al_l pdl_3 noborder_l item_t_border" colspan="4">
                        <input type="hidden" id="detailList3.SerialNum" name="detailList[3].SerialNum" value="4">
                        <input type="hidden" id="detailList3.PurchaseDT" name="detailList[3].PurchaseDT" value="">
                        <input class="in_txt numeric al_c in_detail" maxlength="2" style="width:67%; height:25px;" tabindex="50" type="text" id="detailList3.PurchaseDT1" value="">
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="4">
                        <input class="in_txt numeric al_c in_detail" maxlength="2" style="width:67%; height:25px;" tabindex="50" type="text" id="detailList3.PurchaseDT2" value="">
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="24">
                        <textarea class="txt_ar" maxlength="100" style="width:81%; height:25px;" tabindex="50" id="detailList3.ItemName" name="detailList[3].ItemName"></textarea><button class="mgt_3 mgl_3" type="button" id="btnViewItem_3"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_search.gif"></button>
                    </td>
                    <td class="al_l pdl_3 item_border" colspan="14"><textarea class="txt_ar" maxlength="60" style="width:91%; height:25px;" tabindex="50" id="detailList3.Spec" name="detailList[3].Spec"></textarea></td>
                    <td class="al_l pdl_3 item_border pet2" colspan="8"><input class="in_txt numeric number al_r in_detail" maxlength="16" style="width:85%; height:25px;" tabindex="50" type="text" id="detailList3.Qty" name="detailList[3].Qty" value=""></td>
                    <td class="al_l pdl_3 item_border pet3" colspan="8"><input class="in_txt numeric number al_r in_detail" maxlength="22" style="width:85%; height:25px;" tabindex="50" type="text" id="detailList3.UnitCost" name="detailList[3].UnitCost" value=""></td>
                    <td class="al_l pdl_3 item_border pet4" colspan="12"><input class="in_txt numeric money al_r in_detail" maxlength="22" style="width:89%; height:25px;" tabindex="50" type="text" id="detailList3.SupplyCost" name="detailList[3].SupplyCost" value=""></td>
                    <td class="al_l pdl_3 item_border pet5" colspan="10"><input class="in_txt numeric money al_r in_detail" maxlength="22" style="width:89%; height:25px;" tabindex="50" type="text" id="detailList3.Tax" name="detailList[3].Tax" value=""></td>
                    <td class="al_l pdl_3 item_border" colspan="12"><textarea class="txt_ar" maxlength="100" style="width:89%; height:25px;" tabindex="50" id="detailList3.Remark" name="detailList[3].Remark"></textarea></td>
                    <td class="al_c item_border" colspan="4"><button type="button" id="btnDelItem_3"><img alt="" class="val_m pdt_3" src="/images/common/write/icon_del.gif"></button></td>
                </tr>
            </tbody>
            <tbody id="taxTotalList">
                <tr>
                    <th class="splitline noborder_t" colspan="50"></th>
                    <th class="splitline noborder_t" colspan="50"></th>
                </tr>
                <tr>
                    <th class="al_c noborder_l" colspan="26"><span class="bold">합&nbsp;계&nbsp;금&nbsp;액</span></th>
                    <th class="al_c" colspan="12">현&nbsp;&nbsp;&nbsp;금</th>
                    <th class="al_c" colspan="12">수&nbsp;&nbsp;&nbsp;표</th>
                    <th class="al_c" colspan="12">어&nbsp;&nbsp;&nbsp;음</th>
                    <th class="al_c" colspan="12">외상미수금</th>
                    <th class="al_c" colspan="26" rowspan="2">
                        <div class="PT fl_l" style="width:100%;">
                            <span class="pt1 c_333">이 금액을</span>
                            <div class="pt_s">
                                <p><input class="rad" id="PurposeType1" tabindex="55" type="radio" value="영수" name="PurposeType"><label class="for c_333" for="PurposeType1">영수</label></p>
                                <p><input checked="checked" class="rad" id="PurposeType2" tabindex="55" type="radio" value="청구" name="PurposeType"><label class="for c_333" for="PurposeType2">청구</label></p>
                                <p><input class="rad" id="PurposeType3" tabindex="55" type="radio" value="없음" name="PurposeType"><label class="for c_333" for="PurposeType3">없음</label></p>
                            </div>
                            <span class="pt2 c_333">함</span>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td class="al_l pdl_3 noborder_l" colspan="26"><input class="in_txt readonly al_r" maxlength="22" readonly="readonly" style="width:95%;" type="text" id="TotalAmount" name="TotalAmount" value=""></td>
                    <td class="al_l pdl_3" colspan="12"><input class="in_txt numeric money al_r" maxlength="22" style="width:90%;" tabindex="51" type="text" id="Cash" name="Cash" value=""></td>
                    <td class="al_l pdl_3" colspan="12"><input class="in_txt numeric money al_r" maxlength="22" style="width:90%;" tabindex="52" type="text" id="ChkBill" name="ChkBill" value=""></td>
                    <td class="al_l pdl_3" colspan="12"><input class="in_txt numeric money al_r" maxlength="22" style="width:90%;" tabindex="53" type="text" id="Note" name="Note" value=""></td>
                    <td class="al_l pdl_3" colspan="12"><input class="in_txt numeric money al_r" maxlength="22" style="width:90%;" tabindex="54" type="text" id="Credit" name="Credit" value=""></td>
                </tr>
            </tbody>
        </table>
        <div id="tax_button" class="invoicer_border">
            <div>
                <div class="fl_l">
                    <p class="btn_normal mgt_2" id="taxTemp"><a>임시저장</a></p>

                    <p class="btn_normal mgl_5 mgt_2" id="btnFormReset"><a>작성취소</a></p>

                    <p class="btn_normal mgl_5 mgt_2" id="taxSendEx" tabindex="57"><a class="hand">발행예정</a></p>

                </div>
                <div class="fl_r">
                    <p class="btn_action" id="taxRegistIssue" tabindex="56"><img class="hand val_m mgr_5" src="/images/common/btn/btn_action_icon.gif">발행</p>
                </div>
                <div class="fl_r autoDeal mgt_8">
                    <input class="ckb" id="AutoWriteDealInvoice" name="AutoWriteDealInvoice" type="checkbox" value="1"><label class="for" for="AutoWriteDealInvoice">거래명세서 동시 작성</label>
                </div>

            </div>

        </div>
    </div>














</div>
