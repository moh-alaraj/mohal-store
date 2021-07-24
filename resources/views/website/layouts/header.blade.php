
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
                        <div class="btn-group ps-dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login & Register<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('website.register')}}">Register</a></li>
                                <li><a href="{{route('website.login')}}">Log in</a></li>
                            </ul>
                        </div>
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
            <div class="navigation__column center">
                <ul class="main-menu menu">
                    <li class="menu-item menu-item-has-children dropdown"><a href="{{route('website.index')}}">Home</a>
{{--                        <ul class="sub-menu">--}}
{{--                            <li class="menu-item"><a href="index.html">Homepage #1</a></li>--}}
{{--                            <li class="menu-item"><a href="#">Homepage #2</a></li>--}}
{{--                            <li class="menu-item"><a href="#">Homepage #3</a></li>--}}
{{--                        </ul>--}}
                    </li>
                    @foreach($categories as $category)
                        <li class="menu-item menu-item-has-children dropdown"><a href="#">{{$category->name}}</a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="contact-us.html">Contact Us #1</a></li>
                                <li class="menu-item"><a href="contact-us.html">Contact Us #2</a></li>
                            </ul>
                        </li>
                     @endforeach
    </nav>
</header>
<div class="header-services">
    <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
    </div>
</div>

