<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InsuranceController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






Route::get('/urun-kodlari', [InsuranceController::class, 'getProductCodes']);
Route::match(['get', 'post'], '/fiyat-al', [InsuranceController::class, 'getPrice']);

//Route::post('/fiyat-al', [InsuranceController::class, 'getPrice']);