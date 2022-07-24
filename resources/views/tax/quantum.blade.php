<script src="https://cdn.tailwindcss.com"></script>

<h1>Quantum Tax for Shop</h1>
<p>퀀텀 관리자, 세금계산서 전체 목록을 출력합니다.</p>

<div class="w-1/2">
    <form onsubmit="return false;" class="space-y-6">
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="month" class="font-medium md:w-1/3 flex-none md:mr-2">발행월</label>
          <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
          type="text" id="month" name="month" placeholder="요일 선택">
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
            <label for="seller" class="font-medium md:w-1/3 flex-none md:mr-2">공급자</label>
            <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
            type="text" id="seller" name="seller" placeholder="공급자">
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
            <label for="buyer" class="font-medium md:w-1/3 flex-none md:mr-2">공급받는자</label>
            <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
            type="text" id="buyer" name="buyer" placeholder="공급받는자">
        </div>

        <div class="md:w-2/3 ml-auto">
          <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none md:ml-2 px-3 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
            검색
          </button>
        </div>
    </form>
</div>

<ul>
    <li>
        발행이 완료된 목록은 수정이 불가능합니다.
    </li>
</ul>



<br>

<div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white">
    <table class="min-w-full text-sm align-middle whitespace-nowrap">
        <thead>
            <tr class="border-b border-gray-200">
                <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">id</th>
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
                    {{$item->id}}
                </td>
                <td class="p-3">
                    {{$item->write_date}}
                </td>
                <td class="p-3">
                    <a href="/quantum/tax/detail/{{$item->invoicer_mgt_key}}">{{$item->invoicer_mgt_key}}</a>

                    @if($item->status)
                    <span class="text-gray-600">[수정불가]</span>
                    @else
                    <span class="text-red-600">[수정]</span>
                    @endif

                </td>
                <td class="p-3">
                    {{$item->invoicer_corp_num}}
                </td>
                <td class="p-3">
                    {{$item->invoicee_corp_name}}
                </td>

                <td class="p-3 space-x-2">
                    @if($item->status)
                    <span class="font-semibold inline-flex px-2 py-1 leading-4 text-sm rounded text-gray-600 bg-gray-100">발행완료</span>
                    @else
                    <span class="font-semibold inline-flex px-2 py-1 leading-4 text-sm rounded text-pink-700 bg-pink-200">발행</span>
                    @endif

                    @if($item->edited)
                    <span class="font-semibold inline-flex px-2 py-1 leading-4 text-sm rounded text-yellow-800 bg-yellow-300">수정완료</span>
                    @endif

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
