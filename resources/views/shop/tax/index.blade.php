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
        <h1 class="text-2xl text-bold">{{$shop->shop_name}}</h1>
        <p>등록된 세금계산서 목록입니다. <br>
            임시등록을 선택하시면 팝빌로 세금계산서 정보가 등록됩니다. <br>
            발행을 클릭하면 임시등록된 계산서가 국세청으로 전송됩니다. <br>
        </p>

        <div class="flex justify-between py-4">
            <div>
                @include('tax::shop.tax.search')
            </div>
            <div>
                <a href="/quantum/shop/{{$shop->shop_id}}/tax/create"
                    class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
                    신규등록
                </a>
            </div>
        </div>


        @include('tax::shop.tax.table',['rows'=>$rows])
    </div>

</body>
</html>



