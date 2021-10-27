<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use Illuminate\Http\Request;
use PayPalHttp\HttpException;

class PaymentsController extends Controller
{

    protected function getClient(){
        $config = config('services.paypal');
        $environment = new SandboxEnvironment($config['client_id'], $config['client_secret']);
        $client = new PayPalHttpClient($environment);
        return $client;
    }
    public function create(Order $order){

        $client = $this->getClient();
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => $order->id,
                "amount" => [
                    "value" => $order->total,
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => url(route('paypal.cancel')),
                "return_url" => url(route('paypal.callback'))
            ]
        ];

        try {

            $response = $client->execute($request);
            if ( $response->statusCode == 201 && isset($response->result)){
                Session::put('paypal_order_id',$response->result->id);
//                Session::put('item_order_id',$order->id);
                foreach ($response->result->links as $link){
                    if($link->rel == 'approve'){
                        return redirect()->away($link->href);
                    }
                }
            }



        }catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }

    }
    public function callback(Request $request){

        $pay_id = Session::get('paypal_order_id');
//        $order_id = Session::get('item_order_id');

        $request = new OrdersCaptureRequest($pay_id);
        $request->prefer('return=representation');
        try {
            $client = $this->getClient();

            $response = $client->execute($request);


            if ( $response->statusCode == 201 && isset($response->result)){

                $order_id = $response->result->purchase_units[0]->reference_id;

                if ($response->result->status == 'COMPLETED'){
                    $order = Order::where('id',$order_id)->first();
                    $order->status = 'completed';
                    $order->update();
                    Session::forget('paypal_order_id');
                    Cart::where('cart_id',App::make('cart.id'))->delete();
                    return redirect('/')->with('status','Thank you');
                }

            }
        }catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }


    }



}
