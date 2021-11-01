<?php


use App\Http\Controllers\CoinController;
use App\Http\Controllers\website\HomeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\website\ProductController;
use \App\Http\Controllers\website\CartController;
use \App\Http\Controllers\website\CheckoutController;
use \App\Http\Controllers\website\ContactController;
use \App\Http\Controllers\PaymentsController;
use \App\Http\Controllers\FatoorahController;
use \App\Http\Controllers\admin\NotificationController;
use \App\Http\Controllers\admin\OrderController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth','verified'])
    ->name('dashboard');

require __DIR__.'/auth.php';



Route::get('/',[HomeController::class,'index'])->name('website.index');
Route::get('/products/{slug}',[ProductController::class,'show'])->name('website.show');



Route::get('cart',[CartController::class,'index'])->name('cart');
Route::post('cart',[CartController::class,'store']);

Route::get('checkout',[CheckoutController::class,'index'])->name('checkout');
Route::post('checkout',[CheckoutController::class,'store']);

Route::get('contact',[ContactController::class,'index'])->name('contact');

Route::get('/categories/{slug}',[HomeController::class,'show'])->name('website.categories');



Route::get('payments/{order}',[PaymentsController::class,'create'])->name('paypal.create');
Route::any('payments/paypal/callback',[PaymentsController::class,'callback'])->name('paypal.callback');
Route::any('payments/paypal/cancel',[PaymentsController::class,'cancel'])->name('paypal.cancel');

Route::get('pay/{order}', [FatoorahController::class,'payorder'])->name('fatoorah.create');
Route::get('pay/callback/{order_id}', [FatoorahController::class,'callBack'])->name('fatoorah.callback');
//Route::get('pay/cancel', [FatoorahController::class,'cancel'])->name('fatoorah.cancel');


Route::get('coin/{order}', [CoinController::class,'pay'])->name('coingate.create');
Route::get('coin/success/{order_id}', [CoinController::class,'callBack'])->name('coingate.success');
Route::get('coin/cancel/{order_id}', [CoinController::class,'cancel'])->name('coingate.cancel');









        Route::group([
            'namespace' => 'admin',
            'prefix'=> 'admin',
            'as' => 'admin.',
            'middleware' => ['auth', 'admin:admin,store']
        ],function (){
            Route::resource('products', 'ProductsController');
            Route::resource('categories', 'CategoriesController');
            Route::resource('roles', 'RolesController');
            Route::resource('stores','StoresController');
            Route::resource('advertise', 'AdvertisesController');
            Route::get('notifications',[NotificationController::class,'index'])->name('notifications');
            Route::get('orders',[OrderController::class,'index'])->name('orders');

        });








