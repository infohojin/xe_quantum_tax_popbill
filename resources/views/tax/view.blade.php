<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <div class="p-4">
        {{-- 수정된 거래내역일 경우 경고창 출력 --}}
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

        <h1 class="text-2xl text-bold py-2">매출문서 작성</h1>
        <p class="py-4">
            매출문서 수정은 팝빌 및 국세청 전송 전에만 수정이 가능합니다.
        </p>



        {{-- 수정 입력폼 --}}
        <form action="/quantum/tax/view/{{$info->id}}" method="post" id="tax-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{$info->id}}">

            <div style="width:1200px; margin: 0 auto;">
                {{-- 발행정보 --}}
                <div class="p-2 bg-gray-200">
                    @include("tax::tax.forms.type")
                </div>

                <div class="border-2 border-red-400 border-solid">
                    {{-- 계산서 해더 정보 --}}
                    <div class="flex items-center p-2">
                        <div class="flex-grow text-2xl text-bold text-center align-middle">
                            세금계산서
                        </div>
                        <div class="mr-2">
                            <div>공 급 자</div>
                            <div>(보관용)</div>
                        </div>
                        <div>
                            <div class="flex mb-1">
                                <div class="w-20">책번호:</div>
                                <div>
                                    <input type="text" name="kwon"
                                    class="text-sm border border-stone-400 w-4 p-0.5"
                                    value="{{ old('kwon', $info->kwon) }}">
                                    <label for="">권</label>
                                    <input type="text" name="ho"
                                    class="text-sm border border-stone-400 w-4 p-0.5"
                                    value="{{ old('ho', $info->kwon) }}">
                                    <label for="">호</label>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="w-20">일련번호:</div>
                                <div>
                                    <input type="text" name="invoicer_mgt_key"
                                    class="text-sm border border-stone-400 p-0.5"
                                    value="{{ old('invoicer_mgt_key', $info->invoicer_mgt_key) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 공급자/공급받는자 정보 --}}
                    <div class="flex border border-t-red-400">
                        <div class="w-1/2">
                            <div class="flex">
                                <div class="w-8 bg-red-200 text-center align-middle">
                                    공<br>급<br>자
                                </div>
                                <div class="px-2 pt-2">
                                    @include("tax::tax.forms.seller")
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2">
                            <div class="flex">
                                <div class="w-8 bg-red-200 text-center align-middle">
                                    공<br>급<br>받<br>는<br>자
                                </div>
                                <div class="px-2 pt-2">
                                    @include("tax::tax.forms.buyer")
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 공급정보 --}}
                    <div class="border border-t-red-400">
                        @include("tax::tax.forms.amount")
                    </div>

                    {{-- 공급상품 --}}
                    <div class="border border-t-red-400">
                        @include("tax::tax.forms.products",['products'=>$products])
                    </div>

                    {{-- 결제정보 --}}
                    <div class="border border-t-red-400">
                        @include("tax::tax.forms.payment")
                    </div>
                </div>

                {{-- 동작 버튼 --}}
                <div class="p-2 bg-gray-200">
                    <div class="flex justify-between">
                        <div>
                            @if($info->invoicer_mgt_key)
                                <button
                                class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-red-700 bg-red-700 text-white hover:text-white hover:bg-red-800 hover:border-red-800 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:bg-red-700 active:border-red-700">
                                    발행
                                </button>
                            @else
                                <button
                                class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-blue-700 bg-blue-700 text-white hover:text-white hover:bg-blue-800 hover:border-blue-800 focus:ring focus:ring-blue-500 focus:ring-opacity-50 active:bg-blue-700 active:border-blue-700">
                                    임시등록
                                </button>
                            @endif

                        </div>
                        <div>
                            @if($info->invoicer_mgt_key)

                            @else
                                <button type="submit"
                                class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">
                                    수정
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
        document.addEventListener("DOMContentLoaded", function(){
            let btn_submit_taxform = document.querySelector('#tax-form');
            btn_submit_taxform.addEventListener('submit', function(e){
                e.preventDefault();
                btn_submit_taxform.submit();
            });
        });
        </script>

    </div>

</body>
</html>





