<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('cart.id',function (){

            $id = Cookie::get('cart_id');
            if (!$id){
                $id = Str::uuid();
                Cookie::queue('cart_id',$id, 60*24*30);
            }
            return $id;

        });

         $carts = Cart::limit(5)->get();
        View::share('carts', $carts);


    }
}
