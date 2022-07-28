<form action="/quantum/shop/{{$shop_id}}/tax/create" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                    {{--
                    <button class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">임시저장</button>
                    <button class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">작성취소</button>
                    <button class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">발행예정</button>
                    --}}
                </div>
                <div>
                    {{--
                    <button type="button" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-red-700 bg-red-700 text-white hover:text-white hover:bg-red-800 hover:border-red-800 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:bg-red-700 active:border-red-700">
                        발행
                    </button>
                    --}}

                    <button type="submit"
                    class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-red-700 bg-red-700 text-white hover:text-white hover:bg-red-800 hover:border-red-800 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:bg-red-700 active:border-red-700">
                        저장
                    </button>

                </div>
            </div>
        </div>
    </div>
</form>
