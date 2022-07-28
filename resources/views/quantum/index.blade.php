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
        <h1 class="text-2xl text-bold">Quantum Tax for Shop</h1>
        <p class="py-4">
            퀀텀 관리자, 세금계산서 전체 목록을 출력합니다.
        </p>

        {{--
        <div class="w-1/2">
            @include("tax::tax.admin.search")
        </div>
        --}}
        @include("tax::quantum.table",['rows'=>$rows])

    </div>
</body>
</html>
