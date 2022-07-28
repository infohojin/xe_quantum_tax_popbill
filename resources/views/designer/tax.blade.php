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
        <h1 class="text-2xl text-bold">designers Tax</h1>
        <p>세금계산서 발행 데이터를 출력합니다.</p>

        <div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white">
            <table class="min-w-full text-sm align-middle whitespace-nowrap">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="w-8 p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">No</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">작성일자</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">문서번호</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">공급자</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">받는자</th>
                        <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">국세청승인번호</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trans as $i=>$item)
                    <tr>
                        <td class="w-8 p-3">
                            {{$i}}
                        </td>
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
                            {{$item->nts_confirm_num}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
