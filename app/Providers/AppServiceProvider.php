<?php

namespace App\Providers;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
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

        if (Auth::check()){
            $user = Auth::user();
            $re_date= clone $user->created_at;

            $ex_date = (clone $re_date)->addYear();

            $time = Carbon::now();

            $remain = $ex_date->diff($time)->days . " " . "يوم";

        }else
            $remain = null;

        View::share('remain', $remain);


        $carts = Cart::limit(5)->get();
         View::share('carts', $carts);


    }
}
