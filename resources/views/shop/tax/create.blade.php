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
            <h1 class="text-2xl text-bold">매출문서작성</h1>
            <p class="py-4">
                발행할 세금계산서를 자체 DB에 저장을 합니다. 세금계산서를 발행하기 위해서는 등록된 내용을 기준으로 팝필에 업로드->발행을 해야 됩니다.
            </p>

            @include("tax::shop.tax.taxform")
        </div>
    </body>
</html>
