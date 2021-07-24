<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
//    public function index(){
//
//        return view('website.show',[
//            'categories' => Category::all(),
//
//        ]);
//    }

    public function show($slug){

        $products = Product::where('slug' , '=' , $slug)->firstOrFail();
        return view('website.products.show',[
            'categories' => Category::all() ,
            'products' => $products
        ]);

    }
}
