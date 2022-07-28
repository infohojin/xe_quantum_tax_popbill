<div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white">
    <table class="min-w-full text-sm align-middle whitespace-nowrap">
        <thead>
            <tr class="border-b border-gray-200">
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">작성일자</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">문서번호</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">공급자</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">받는자</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">국세청승인번호</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $item)
            <tr>
                <td class="p-3">
                    {{$item->write_date}}
                </td>
                <td class="p-3">
                    @if ($item->invoicer_mgt_key)
                        {{$item->invoicer_mgt_key}}
                    @else
                        <a href="/quantum/tax/view/{{$item->id}}"
                            class="text-blue-700">
                            임시등록후 생성 [편집가능]
                        </a>
                    @endif
                </td>
                <td class="p-3">
                    {{$item->invoicer_corp_num}}
                </td>
                <td class="p-3">
                    {{$item->invoicee_corp_name}}
                </td>
                <td class="p-3">
                    @if ($item->invoicer_mgt_key)
                        @if ($item->nts_confirm_num)
                        {{$item->nts_confirm_num}}
                        @else
                        <a href="/quantum/shop/{{$shop->shop_id}}/tax/{{$item->id}}/issue"
                            class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-red-700 bg-red-700 text-white hover:text-white hover:bg-red-800 hover:border-red-800 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:bg-red-700 active:border-red-700">
                                국세청전송
                        </a>
                        @endif
                    @else
                    {{-- 문서번호가 없는 경우는, 팝빌로 전송되지 않은 내역입니다. --}}
                        <a href="/quantum/shop/{{$shop->shop_id}}/tax/{{$item->id}}/regist"
                        class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
                            임시등록
                        </a>
                    @endif

                    {{--
                    @if($item->status == '2')
                        <a href="#" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">
                            발행완료
                        </a>
                    @elseif ($item->status == '1')
                        <a href="/quantum/shop/{{$shop->shop_id}}/tax/{{$item->id}}/issue"
                            class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-red-700 bg-red-700 text-white hover:text-white hover:bg-red-800 hover:border-red-800 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:bg-red-700 active:border-red-700">
                            발행
                        </a>
                    @else
                        <a href="/quantum/shop/{{$shop->shop_id}}/tax/{{$item->id}}/regist"
                        class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
                            전송
                        </a>
                    @endif
                    --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
