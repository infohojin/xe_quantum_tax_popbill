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
    <div class="p-8">
        <h1 class="text-2xl text-bold">Quantum Shop</h1>
        <p>조회할 샵을 선택해 주세요. 해당 샵에 대한 세금계산서 발행 데이터를 출력합니다.</p>

        <div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white">
            <table class="min-w-full text-sm align-middle whitespace-nowrap">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="w-8 p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">No</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">샵이름</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase">사업자번호</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">대표자명</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">이메일</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">업태</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">업종</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">연동가입</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shop as $i=>$item)
                    <tr>
                        <td class="w-8 p-3">
                            {{$i}}
                        </td>
                        <td class="p-3">
                            <a href='/quantum/shop/{{$item->shop_id}}/tax'>{{$item->business_name}}</a>
                        </td>
                        <td class="p-3">
                            <div>
                                {{$item->business_id}}
                            </div>
                            <div>
                                ({{$item->business_classification}})
                            </div>
                        </td>
                        <td class="p-3">
                            {{$item->ceo_name}}
                        </td>
                        <td class="p-3">
                            <div>{{$item->shop_email}}</div>
                            <div>{{$item->shop_phone_number}}</div>
                        </td>
                        <td class="p-3">
                            {{$item->business_condition}}
                        </td>
                        <td class="p-3">
                            {{$item->business_type}}
                        </td>

                        <td class="p-3">

                            @if (isset($item->popbill))
                                <a href="/quantum/shop/{{$item->shop_id}}/tax/certificate"
                                    class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">
                                    인증서관리
                                </a>
                            @else
                                <a href="/quantum/shop/{{$item->shop_id}}/tax/join"
                                class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
                                연동가입
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <table>

        </table>
    </div>

</body>
</html>
