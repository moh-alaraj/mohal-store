<?php


use App\Http\Controllers\website\HomeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\website\ProductController;
use \App\Http\Controllers\website\CartController;
use \App\Http\Controllers\website\CheckoutController;





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

Route::get('/',[HomeController::class,'index'])->name('website.index');
Route::get('/products/{slug}',[ProductController::class,'show'])->name('website.show');

Route::get('cart',[CartController::class,'index'])->name('cart');
Route::post('cart',[CartController::class,'store']);

Route::get('checkout',[CheckoutController::class,'index'])->name('checkout');
Route::post('checkout',[CheckoutController::class,'store']);



        Route::group([
            'namespace' => 'admin',
            'prefix'=> 'admin',
            'as' => 'admin.',
            'middleware' => ['auth', 'admin:admin,store']
        ],function (){
            Route::resource('products', 'ProductsController');
            Route::resource('categories', 'CategoriesController');
            Route::resource('roles', 'RolesController');
            Route::resource('advertise', 'AdvertisesController');



        });


        Route::get('/dashboard', function () {
            return view('dashboard');
             })
            ->middleware(['auth','verified'])
             ->name('dashboard');

        require __DIR__.'/auth.php';



