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
        <h1>인증서 정보관리</h1>
        {{$shop->shop_name}}
    </div>

    <hr>
    <div class="p-8">
        @if ($cert)
        <ul>
            @foreach ( $cert as $key=>$value)
                <li>
                    <span>{{$key}}:</span>
                    <span>{{$value}}</span>
                </li>
            @endforeach
        </ul>
        @endif
    </div>

    <hr>

    <div class="p-8">
        <a href="{{$url}}" target="_blank"
        class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
            인증서등록
        </a>
    </div>



</body>
</html>
