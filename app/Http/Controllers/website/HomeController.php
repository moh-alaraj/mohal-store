<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

//        $data = [
//            'stores'        => Store::all(),
//            'categories'    => Category::all(),
//            'products'      => Product::all(),
//            ];
        return view('website.index',[
            'categories' => Category::all(),
            'products'   =>Product::all()
        ]);

    }
}
