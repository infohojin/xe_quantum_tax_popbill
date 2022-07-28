# 세금계산서 연동
라라벨 공식 패키지 생성으로 모듈화 되어 개발 하였습니다.

## 설치
0. 링크허브 설치
```
composer require linkhub/popbill
```

1. 모듈을 폴더에 복사합니다.
ex) /modules/tax

2. config/app.php 에 프로바이더를 연결합니다.
```php
XEHub\XePlugin\CustomQuantum\Tax\TaxServiceProvider::class,
```

3. 컴포저 네임스페이스를 등록합니다.
```
"XEHub\\XePlugin\\CustomQuantum\\Tax\\": "modules/tax/src"
```

## 폴더 설명
* /routes/web.php : 라우트 설정값
* resources : 리소스
* src : 소소
* database : 데이터베이스
