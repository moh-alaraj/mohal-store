
<div class="header--sidebar"></div>
<header class="header">
    <div class="header__top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                    <p>Palestine Gaza</p>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
                    <div class="header__actions">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <div class="btn-group ps-dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                   <li><a class="q" href="#" onclick="document.getElementById('logout').submit()">Logout</a></li>
                                    <form id="logout" class="d-none" action="{{route('logout')}}" method="post">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        @else
                        <div class="btn-group ps-dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login & Register<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('website.register')}}">Register</a></li>
                                <li><a href="{{route('website.login')}}">Log in</a></li>
                            </ul>
                        </div>
                        @endif
                       <div class="btn-group ps-dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">USD
                                <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><img src="{{asset('website/images/flag/usa.svg')}}" alt=""> USD</a></li>
                                <li><a href="#"><img src="{{asset('website/images/flag/singapore.svg')}}" alt=""> SGD</a></li>
                                <li><a href="#"><img src="{{asset('website/images/flag/japan.svg')}}" alt=""> JPN</a></li>
                            </ul>
                        </div>
                        <div class="btn-group ps-dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">English</a></li>
                                <li><a href="#">Japanese</a></li>
                                <li><a href="#">Chinese</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="container-fluid">
            <div class="navigation__column left">
                <div class="header__logo"><a class="ps-logo" href="index.html"><img  src="{{asset('website/images/sw.jpg')}}" alt=""></a></div>
            </div>
            <div class="navigation__column center" style="width: auto">
                <ul class="main-menu menu">
                    <li class="menu-item menu-item-has-children dropdown"><a href="{{route('website.index')}}">Home</a> </li>
                    @foreach($categories as $category)
                        <li class="menu-item menu-item-has-children dropdown">
                            <a href="{{route('website.categories',$category->slug)}}">{{$category->name}}</a>
                        </li>
                    @endforeach
                    <li class="menu-item menu-item-has-children dropdown"><a href="{{route('contact')}}">Contact US</a></li>
                    <div class="ps-cart" style="margin-top: 15px;">
                        <a class="ps-cart__toggle" href="{{route('cart')}}" ><span><i>{{count($carts)}}</i></span>
                            <i class="ps-icon-shopping-cart"></i>
                        </a>
                        @if(count($carts) > 0 )
                        <div class="ps-cart__listing">
                                    <div class="ps-cart__content">
                                            @foreach($carts as $cart)
                                                <div class="ps-cart-item">
                                                    <img width="50"  src="{{$cart->product->image_link}}" alt="">
                                                    <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="{{route('website.show',$cart->product->slug)}}">{{$cart->product->name}}</a>
                                                        <p><span>Quantity:<i>{{$cart->quantity}}</i></span><span>Total:<i>{{$cart->product->sale_price * $cart->quantity}}$</i></span></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                                <div class="ps-cart__footer"><a class="ps-btn" href="{{route('checkout')}}">Check out<i class="ps-icon-arrow-left"></i></a></div>
                                    </div>
                        </div>
                        @endif
                    </div>

                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="header-services">
    <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
    </div>
</div>

