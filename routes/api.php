<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('consumer')->namespace('consumer')->group(function(){
    Route::post('register','ConsumerRegistrationController@register');
    Route::post('login','ConsumerLoginController@login');
    Route::middleware(['auth:consumer-api','scope:consumer'])->group(function(){
        Route::apiResource('cart','CartController');
    });
});
Route::prefix('merchant')->namespace('merchant')->group(function(){
    Route::post('register','MerchantRegistrationController@register');
    Route::post('login','MerchantLoginController@login');
    Route::middleware(['auth:merchant-api','scope:merchant'])->group(function(){
        Route::apiResource('products','ProductsController');
    });
});
