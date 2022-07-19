<?php

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
