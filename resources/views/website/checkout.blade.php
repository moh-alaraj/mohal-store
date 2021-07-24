@extends('website.layouts.app')

@section('main-content')

    <main class="ps-main">
        @if(session()->has('error'))
            <div class="alert alert-success">
                {{session()->get('error')}}
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
                                            <td>{{$item->total}} $</td>
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
                                            <input class="form-control" type="radio" id="rdo01" name="payment" checked>
                                            <label for="rdo01">Cheque Payment</label>
                                            <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                        </div>
                                    </div>
                                    <div class="form-group paypal">
                                        <div class="ps-radio ps-radio--inline">
                                            <input class="form-control" type="radio" name="payment" id="rdo02">
                                            <label for="rdo02">Paypal</label>
                                        </div>
                                        <ul class="ps-payment-method">
                                            <li><a href="#"><img src="{{asset('website/images/payment/1.png')}}" alt=""></a></li>
                                            <li><a href="#"><img src="{{asset('website/images/payment/2.png')}}" alt=""></a></li>
                                            <li><a href="#"><img src="{{asset('website/images/payment/3.png')}}" alt=""></a></li>
                                        </ul>
                                        <button class="ps-btn ps-btn--fullwidth" type="submit">Place Order<i class="ps-icon-next"></i></button>
                                    </div>
                                </footer>
                            </div>
                            <div class="ps-shipping">
                                <h3>FREE SHIPPING</h3>
                                <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING.<br> <a href="#"> Singup </a> for free shipping on every order, every time.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection
