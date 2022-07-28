<div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white">
    <table class="min-w-full text-sm align-middle whitespace-nowrap">
        <thead>
            <tr class="border-b border-gray-200">
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">id</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">작성일자</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">문서번호</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">공급자</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">받는자</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">국세청전송내역</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $item)
            <tr>
                <td class="p-3">
                    {{$item->id}}
                </td>
                <td class="p-3">
                    {{$item->write_date}}
                </td>
                <td class="p-3">
                    @if($item->invoicer_mgt_key)

                        @if($item->nts_confirm_num)
                            {{$item->invoicer_mgt_key}} [수정불가]
                        @else
                            {{$item->invoicer_mgt_key}}
                        @endif

                    @else
                        <a href="/quantum/tax/view/{{$item->id}}"
                            class="text-blue-700">
                            저장되지 않는 거래
                        </a>
                    @endif

                    @if($item->edited)
                    <span class="font-semibold inline-flex px-2 py-1 leading-4 text-sm rounded text-yellow-800 bg-yellow-300">
                        수정됨
                    </span>
                    @endif

                    {{--
                    {{}}</a>

                    @if($item->status)
                    <span class="text-gray-600">[수정불가]</span>
                    @else
                    <span class="text-red-600">[수정]</span>
                    @endif
                    --}}

                </td>
                <td class="p-3">
                    {{$item->invoicer_corp_num}}
                </td>
                <td class="p-3">
                    {{$item->invoicee_corp_name}}
                </td>

                <td class="p-3 space-x-2">
                    @if($item->nts_confirm_num)
                    <span class="font-semibold inline-flex px-2 py-1 leading-4 text-sm rounded text-gray-600 bg-gray-100">
                        {{$item->nts_confirm_num}}
                    </span>
                    @else
                        @if($item->invoicer_mgt_key)
                        <span class="font-semibold inline-flex px-2 py-1 leading-4 text-sm rounded text-pink-700 bg-pink-200">미발행</span>
                        @else
                        <span class="font-semibold inline-flex px-2 py-1 leading-4 text-sm rounded text-yellow-800 bg-yellow-300">
                            미등록
                        </span>
                        @endif
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
