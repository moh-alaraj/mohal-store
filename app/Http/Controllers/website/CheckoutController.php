<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewOrderCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Psy\Exception\ThrowUpException;

class CheckoutController extends Controller
{
    public function index(Request $request){
        $cart = Cart::with('product')
            ->where('cart_id',App::make('cart.id'))
            ->get();

        $total = $cart->sum(function ($item){
            return $item->product->sale_price * $item->quantity;
        });
        $order = Order::all();


        return view('website.checkout',[
            'categories' => Category::all(),
            'carts' => Cart::limit(5)->get(),
            'cart' => $cart,
            'total' => $total,
            'order' => $order,
        ]);

    }

    public function store(Request $request){

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);
        $cart = Cart::with('product')
            ->where('cart_id',App::make('cart.id'))
            ->get();
        if ($cart->count() == 0){

            return redirect('/');
        }
        $total = $cart->sum(function ($item){
            return $item->product->sale_price * $item->quantity;
        });

        DB::beginTransaction();
        try {
            if ($request->register){

            $user = $this->createUser($request);
            }

            $request->merge([
                'user_id' => Auth::id(),
                'total' => $total,
            ]);

        $order = Order::create($request->all());

        foreach ($cart as $item){
            $order->items()->create([
               'product_id' => $item->product_id,
               'quantity' => $item->quantity,
               'price' =>  $item->product->sale_price,
            ]);

            Product::where('id', $item->product_id)->increment('sales', $item->quantity);
        }
            DB::commit();

            $user = User::where('type', '=' , 'admin')->first();
            $user->notify(new NewOrderCreatedNotification($order));
            if ($request->payment == 'paypal'){
            return redirect("/payments/$order->id");
            }elseif($request->payment == 'fatoorah'){
                return redirect("/pay/$order->id");
            }else{
                return redirect("coin/$order->id");
            }
        }catch (\Throwable $ex){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $ex->getMessage());
        }

    }
    public function createUser(Request $request){

        $user = User::create([
            'name' => $request->first_name . $request->last_name,
            'email' => $request->email,
            'password' => Str::random(8),
        ]);
        return  $user;
    }
}
