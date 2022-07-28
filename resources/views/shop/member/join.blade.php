
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
    <h1>연동회원가입 {{$shop->business_name}}</h1>
    <p>
        세금계산서 발송을 위하여 팝빌 연동회원에 가입을 합니다.
        가입후에는 인증서를 추가로 등록해 주어야 합니다.
    </p>

    <a href="/quantum/shop/{{$shop->shop_id}}/tax/regist"
        class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
        회원 가입하기
    </a>
</body>
</html>
