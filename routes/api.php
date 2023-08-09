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
    Route::post('login','ConsumerLoginController@login')/*->middleware(['auth:consumer-api','scope:consumer'])*/;
});
Route::prefix('merchant')->group(function(){

});
