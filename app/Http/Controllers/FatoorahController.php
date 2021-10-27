<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Services\FatoorahServices;
use Illuminate\Support\Facades\App;

class FatoorahController extends Controller
{

    private $fatoorahServices;

    public function __construct(FatoorahServices $fatoorahServices)
    {
            $this->fatoorahServices = $fatoorahServices;

    }


    public function payorder(Order $order){

        $fatoorah = config('services.fatoorah');

    $data = [
        'CustomerName'     => $order->first_name . $order->last_name,
        'CustomerMobile'     => $order->phone_number,
        'CustomerEmail'      => $order->email,
        'CustomerReference'  => $order->id,
        'NotificationOption' => 'Lnk',
        'InvoiceValue'       => $order->total ,
        'Language'           => 'en',
        'DisplayCurrencyIso' => 'KWD',
        'CallBackUrl'        => route($fatoorah['fatoorah_success'],$order->id),
        'ErrorUrl'           => $fatoorah['fatoorah_failed'],
        ];


        return $this->fatoorahServices->sendPayment($data);

    }

    public function callBack(Request $request, $id){

        $data = [
            'key' => $request->paymentId,
            'KeyType' => 'paymentId'
        ];

        $info =  $this->fatoorahServices->getPaymentStatus($data);

         Cart::where('cart_id',App::make('cart.id'))->delete();

        $order_id  = Order::where('id','=',$id)->first();
        $order_id->status = 'completed';
        $order_id->update();

        return redirect('/')->with('status', 'order paid succefully');

    }
}
