<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\ProductsController;
use \App\Http\Controllers\Api\LoginController;
use \App\Http\Controllers\Api\RegisterController;
use \App\Http\Controllers\FatoorahController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('pay/{order}', [FatoorahController::class,'payorder'])->name('fatoorah.create');
Route::get('pay/callback', [FatoorahController::class,'callBack'])->name('fatoorah.callback');


Route::apiResource('products','Api\ProductsController');
Route::post('register',[RegisterController::class,'store']);
Route::post('login',[LoginController::class,'logIn']);
Route::post('logout',[LoginController::class,'logout'])->middleware('auth:sanctum');



//Route::get('/products',[ProductsController::class,'index']);
//Route::get('/products/{id}',[ProductsController::class,'show']);
//Route::post('/products',[ProductsController::class,'store']);
//Route::put('/products/{id}',[ProductsController::class,'update']);
//Route::delete('/products/{id}',[ProductsController::class,'destroy']);




