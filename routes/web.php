<?php
// 목록
Route::get('/quantum', function () {
    return view('tax::index');
});

// 컨텀:전체 발행목록
use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\QuantumShopTax;
Route::get('/quantum/shop/tax',[QuantumShopTax::class,"taxlist"]);


use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\QuantumTaxDetail;
Route::get('/quantum/tax/detail/{doc}',[QuantumTaxDetail::class,"detail"]);
Route::post('/quantum/tax/detail/{doc}',[QuantumTaxDetail::class,"edit"]);

Route::get('/quantum/shop',[QuantumShopTax::class,"shopall"]);
Route::get('/quantum/shop/{uuid}/tax', [QuantumShopTax::class,"shoptax"]);


use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\QuantumDesignerTax;
Route::get('/quantum/designer',[QuantumDesignerTax::class,"designers"]);
Route::get('/quantum/desginer/{uuid}/tax', [QuantumDesignerTax::class,"deginertax"]);




// 전자세금계산서 Route Mapping
Route::get('/Taxinvoice', function () {
    return view('tax::Taxinvoice/index');
});

// 임시발행
use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\TaxinvoiceRegister;
Route::get('/Taxinvoice/Register',[TaxinvoiceRegister::class,"index"]);
Route::post('/Taxinvoice/Register',[TaxinvoiceRegister::class,"Register"]);

use XEHub\XePlugin\CustomQuantum\Tax\Http\Controllers\TaxinvoiceController;
Route::get('/Taxinvoice/{APIName}',[TaxinvoiceController::class,"RouteHandelerFunc"]);
