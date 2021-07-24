<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{

    public function index(){

        $cart = Cart::with('product')
            ->where('cart_id', App::make('cart.id'))
            ->get();

        $total = $cart->sum(function ($item){
            return $item->product->price * $item->quantity;
        });



         return view('website.cart',[
             'cart' => $cart,
             'categories' => Category::all(),
             'total' => $total,
         ]);

    }




    public function store(Request $request){

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'int|min:1'
        ]);

        $product_id = $request->product_id;
        $quantity = $request->quantity;

        $cart = Cart::where([
            'cart_id'       => App::make('cart.id'),
            'product_id'    => $product_id,
        ])->first();

        if ($cart){
            $cart->increment('quantity',$quantity );
        }else{

        $cart = Cart::create([
           'user_id'       => Auth::id(),
           'cart_id'       => App::make('cart.id'),
           'product_id'    => $product_id,
           'quantity'      => $quantity,
        ]);

        }

        return redirect('/')->with('status','product successfully added to cart');
    }


}
