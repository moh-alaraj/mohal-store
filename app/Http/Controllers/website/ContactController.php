<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){

        return view('website.contact',[
            'categories' => Category::all(),
        ]);
    }
}
