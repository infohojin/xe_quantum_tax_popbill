<script src="https://cdn.tailwindcss.com"></script>

<h1>Shop Tax for designers</h1>

<div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white">
    <table class="min-w-full text-sm align-middle whitespace-nowrap">
        <thead>
            <tr class="border-b border-gray-200">
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">작성일자</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">문서번호</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">공급자</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">받는자</th>
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">상태</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trans as $item)
            <tr>
                <td class="p-3">
                    {{$item->write_date}}
                </td>
                <td class="p-3">
                    {{$item->invoicer_mgt_key}}
                </td>
                <td class="p-3">
                    {{$item->invoicer_corp_num}}
                </td>
                <td class="p-3">
                    {{$item->invoicee_corp_name}}
                </td>
                <td class="p-3">
                    @if($item->status)
                        <a href="#" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none md:ml-2 px-3 py-2 leading-5 text-sm rounded border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">발행완료</a>
                    @else
                        <a href="#" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none md:ml-2 px-3 py-2 leading-5 text-sm rounded border-red-700 bg-red-700 text-white hover:text-white hover:bg-red-800 hover:border-red-800 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:bg-red-700 active:border-red-700">발행</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

