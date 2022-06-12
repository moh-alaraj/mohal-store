<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){


        if (Auth::check()){
        $user = Auth::user();
        $re_date= clone $user->created_at;

        $ex_date = (clone $re_date)->addYear();

        $time = Carbon::now();

        $remain = $ex_date->diff($time)->days . " " . "يوم";

        }else
            $remain=null;

        return view('website.index',[
            'categories' => Category::whereHas('products')->get(),
            'products'   => Product::all(),
            'ads'        => Advertise::inRandomOrder()->limit(2)->get(),
            't_sales'    => Product::OrderBy('sales', 'desc')->limit(5)->get(),
            'remain'     => $remain

        ]);

    }
    public function show($slug)
    {
            $products = Product::whereHas('category', function($query) use ($slug) {
                $query->where('slug', '=', $slug);
            })->get();

            $c_name = Category::where('slug' ,'=',$slug)->first();

        return view('website.categories.show', [
            'categories' => Category::whereHas('products')->get(),
            'products' => $products,
            'c_name' => $c_name

        ]);
    }

    }
