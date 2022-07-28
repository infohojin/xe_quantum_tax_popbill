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
        <h1 class="text-2xl text-bold">Desginer</h1>
        <p>조회할 디자이너를 선택해 주세요. 세금계산서 발행 데이터를 출력합니다.</p>
        <a href="/quantum/shop/tax">전체발행내역</a>

        <div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white">
            <table class="min-w-full text-sm align-middle whitespace-nowrap">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="w-8 p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">No</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">디자이너</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">사업자번호</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">상호명</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($designer as $i=>$item)
                    <tr>
                        <td class="w-8 p-3">
                            {{$i}}
                        </td>
                        <td class="p-3">
                            <a href='/quantum/desginer/{{$item->user_id}}/tax'>{{$item->display_name}}</a>
                        </td>
                        <td class="p-3">
                            @if(isset($item->business))
                            {{$item->business->business_id}}
                            @else
                            -----
                            @endif
                        </td>
                        <td class="p-3">
                            @if(isset($item->business))
                            {{$item->business->business_name}}
                            @else
                            -----
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
