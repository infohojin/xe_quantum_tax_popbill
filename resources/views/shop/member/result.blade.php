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
    <h1>{{$shop->shop_name}}</h1>

    {{-- API 결과 출력 --}}
    <fieldset class="fieldset1">
        <legend>상태</legend>
        <ul>
            <li>code (응답코드) : {{ $code }}</li>
            <li>message (응답메시지) : {{ $message }}</li>
            @isset($ntsConfirmNum)
            <li>ntsConfirmNum (국세청 승인번호) : {{ $ntsConfirmNum }}</li>
            @endisset
            @isset($receiptID)
            <li>$receiptID (접수 아이디) : {{ $receiptID }}</li>
            @endisset
            @isset($confirmNum)
            <li>confirmNum (국세청 승인번호) : {{ $confirmNum }}</li>
            @endisset
            @isset($tradeDate)
            <li>tradeDate (거래일자) : {{ $tradeDate }}</li>
            @endisset
            @isset($invoiceNum)
            <li>invoiceNum (팝빌 승인번호) : {{ $invoiceNum }}</li>
            @endisset
        </ul>
    </fieldset>

    <hr>

    <h2>인증서등록</h2>
    <p>세금계산서를 발행하기 위해서는 인증서를 등록해야 합니다.</p>

    <a href="{{$url}}" target="_blank"
    class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
        인증서등록
    </a>



</body>
</html>
