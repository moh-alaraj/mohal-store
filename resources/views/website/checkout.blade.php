@extends('website.layouts.app')
@section('css')


@endsection
@section('main-content')

    <main class="ps-main">
        @if(session()->has('error'))
            <div class="alert alert-success">
                {{session()->get('error')}}
            </div>
        @endif
            @if(session()->has('status'))
                <div class="alert alert-success">
                    {{session()->get('status')}}
                </div>
            @endif

        <div class="ps-checkout pt-80 pb-80">
            <div class="ps-container">
                <form class="ps-checkout__form" action="{{route('checkout')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                            <div class="ps-checkout__billing">
                                <h3>Billing Detail</h3>
                                <div class="form-group form-group--inline">
                                    <label>First Name<span>*</span>
                                    </label>
                                    <input class="form-control" name="first_name" type="text">
                                </div>
                                <div class="form-group form-group--inline">
                                    <label>Last Name<span>*</span>
                                    </label>
                                    <input class="form-control" name="last_name" type="text">
                                </div>
                                <div class="form-group form-group--inline">
                                    <label>Email Address<span>*</span>
                                    </label>
                                    <input class="form-control" name="email" type="email">
                                </div>
                                <div class="form-group form-group--inline">
                                    <label>Country<span>*</span></label>
                                    <select name="country_code" class="form-control" >
                                        <option value="">Select Country</option>
                                            @foreach( Symfony\Component\Intl\Languages::getNames('en') as $code => $name)
                                            <option value="{{$code}}">
                                                {{$name}}
                                            </option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-group--inline">
                                    <label> City<span>*</span>
                                    </label>
                                    <input class="form-control" name="city" type="text">
                                </div>
                                <div class="form-group form-group--inline">
                                    <label>Phone<span>*</span>
                                    </label>
                                    <input class="form-control" name="phone_number" type="text">
                                </div>
                                @guest
                                <div class="form-group">
                                    <div class="ps-checkbox">
                                        <input class="form-control" type="checkbox" name="register" value="1" id="cb01">
                                        <label for="cb01">Create an account?</label>
                                    </div>
                                </div>
                                @endguest
                                <h3 class="mt-40"> Addition information</h3>
                                <div class="form-group form-group--inline textarea">
                                    <label>Order Notes</label>
                                    <textarea  name="notes" class="form-control" rows="5" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                            <div class="ps-checkout__order">
                                <header>
                                    <h3>Your Order</h3>
                                </header>
                                <div class="content">
                                    <table class="table ps-checkout__products">
                                        <thead>
                                        <tr>
                                            <th class="text-uppercase">Product</th>
                                            <th class="text-uppercase">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cart as $item)
                                        <tr>
                                            <td>{{$item->product->name}} x{{$item->quantity}}</td>
                                            <td>{{$item->product->sale_price * $item->quantity}}  $</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td>Order Total</td>
                                            <td>{{$total}}$</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <footer>
                                    <h3>Payment Method</h3>
                                    <div class="form-group cheque">
                                        <div class="ps-radio">
                                            <input class="form-control" type="radio" id="rdo01" name="payment"  value="fatoorah">
                                            <label for="rdo01">My Fatoorah</label>
                                            <p> Benfit, Knet , Amex , Sadad , STC Pay , Visa , Mastercard , Mada </p>
                                        </div>
                                    </div>
                                    <div class="form-group cheque" style = "border-top: none">
                                        <div class="ps-radio">
                                            <input class="form-control" type="radio" id="rdo05" name="payment"  value="paytab">
                                            <label for="rdo05">Paytab</label>
                                        </div>
                                    </div>
                                    <div class="form-group cheque" style="border-top: none">
                                        <div class="ps-radio">
                                            <input class="form-control" type="radio" id="rdo02" name="payment"  value="paymob">
                                            <label for="rdo02">Paymob</label>
                                            <p> Card, wallet, kiosk, etc... </p>
                                        </div>
                                    </div>
                                    <div class="form-group cheque" style="border-top: none">
                                        <div class="ps-radio">
                                            <input class="form-control" type="radio" id="rdo03" name="payment"  value="coin">
                                            <label for="rdo03"> Cryptocurrency</label>
                                            <p> pay using crypto: BTC, LTC, ETH </p>
                                        </div>
                                    </div>
                                    <div class="form-group paypal">
                                        <div class="ps-radio ps-radio--inline">
                                            <input class="form-control" type="radio" name="payment"  value="paypal" id="rdo04">
                                            <label for="rdo04">Paypal</label>
                                        </div>
                                        <button class="ps-btn ps-btn--fullwidth" type="submit">Place Order<i class="ps-icon-next"></i></button>
                                    </div>
                                </footer>
                            </div>
{{--                            <div class="ps-shipping">--}}
{{--                                <h3>FREE SHIPPING</h3>--}}
{{--                                <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING.<br> <a href="{{route('website.register')}}"> Singup </a> for free shipping on every order, every time.</p>--}}
{{--                            </div>--}}
                            <script src="https://www.paypal.com/sdk/js?client-id=AbJs6vCJ16igccGzlm9UCt5NJzVe1KkWbYa8VB_-XuXonmUL_2QNIW4VaFdF4esfAuIEweli58ys_6dG&currency=USD"></script>
                            <!-- Set up a container element for the button -->
                            <div id="paypal-button-container"></div>
                            <script>
                                paypal.Buttons({

                                    // Sets up the transaction when a payment button is clicked
                                    createOrder: (data, actions) => {
                                        return actions.order.create({

                                            purchase_units: [{
                                                amount: {
                                                    value: @json($total)   // Can also reference a variable or function
                                                }
                                            }]
                                        });
                                    },
                                    // Finalize the transaction after payer approval
                                    onApprove: (data, actions) => {
                                        return actions.order.capture().then(function(orderData) {
                                            // Successful capture! For dev/demo purposes:
                                            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                                            const transaction = orderData.purchase_units[0].payments.captures[0];
                                            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                                            // When ready to go live, remove the alert and show a success message within this page. For example:
                                            // const element = document.getElementById('paypal-button-container');
                                            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                                            // Or go to another URL:  actions.redirect('thank_you.html');
                                        });
                                    }
                                }).render('#paypal-button-container');
                            </script>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection
