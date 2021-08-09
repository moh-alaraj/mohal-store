<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        return view('website.index',[
            'categories' => Category::all(),
            'products'   =>Product::all(),
            'ads'        =>Advertise::inRandomOrder()->limit(2)->get()
        ]);

    }
}
