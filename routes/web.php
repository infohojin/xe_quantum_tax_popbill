<?php
// 목록
Route::get('/quantum', function () {
    return view('tax::index');
});

// 세금계산서 발행목록
use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\InvoiceTaxController;
Route::get('/quantum/shop/tax',[InvoiceTaxController::class,"admin"]);

// 샵관리 페이지
// 컨텀샵 목록 및 계산서 발행내역
use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\QuantumShopTax;
Route::get('/quantum/shop',[QuantumShopTax::class,"shop"]); // 샵목록 출력
    use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\Join\TaxMembersController;
    Route::get('/quantum/shop/{uuid}/tax/join', [TaxMembersController::class,"join"]); //연동회원 가입동의
    Route::get('/quantum/shop/{uuid}/tax/regist', [TaxMembersController::class,"regist"]); //API 호출 가입
    Route::get('/quantum/shop/{uuid}/tax/certificate', [TaxMembersController::class,"certificate"]); //인증서 관리

    Route::get('/quantum/shop/{uuid}/tax', [QuantumShopTax::class,"shoptax"]); //저장된 세금계산서 목록
    Route::get('/quantum/shop/{uuid}/tax/create',[QuantumShopTax::class, "create"]); // 신규 계산서입력폼
    Route::post('/quantum/shop/{uuid}/tax/create',[QuantumShopTax::class, "store"]); // 신규 DB등록

    //발행 프로세스
    Route::get('/quantum/shop/{uuid}/tax/{tid}/regist', [QuantumShopTax::class,"regist"]); // 팝빌 임시등록
    Route::get('/quantum/shop/{uuid}/tax/{tid}/issue', [QuantumShopTax::class,"issue"]); // 팝빌 임시등록


// 세금계산서 관리
use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\QuantumTaxDetail;
Route::get('/quantum/tax/view/{tid}',[QuantumTaxDetail::class,"view"]);
Route::post('/quantum/tax/view/{tid}',[QuantumTaxDetail::class,"update"]);


// 디자이너
use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\QuantumDesignerTax;
Route::get('/quantum/designer',[QuantumDesignerTax::class,"designers"]);
Route::get('/quantum/desginer/{uuid}/tax', [QuantumDesignerTax::class,"deginertax"]);






/*

Route::get('/quantum/tax/detail/{doc}',[QuantumTaxDetail::class,"detail"]);
Route::post('/quantum/tax/detail/{doc}',[QuantumTaxDetail::class,"edit"]);









// 전자세금계산서 Route Mapping
Route::get('/Taxinvoice', function () {
    return view('tax::Taxinvoice/index');
});

// 임시발행
use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\TaxinvoiceRegister;
Route::get('/Taxinvoice/Register',[TaxinvoiceRegister::class,"index"]);
Route::post('/Taxinvoice/Register',[TaxinvoiceRegister::class,"register"]);

use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\TaxinvoiceController;
*/
