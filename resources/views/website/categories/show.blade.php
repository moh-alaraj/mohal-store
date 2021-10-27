@extends('website.layouts.app')

@section('main-content')

    <main class="ps-main">

        @if(session()->has('status'))
            <div class="alert alert-success">
                {{session()->get('status')}}
            </div>
        @endif
            <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
                <div class="ps-container">
                    <div class="ps-section__header mb-50">

                        <h3 class="ps-section__title" data-mask="{{$c_name->name}}">{{$c_name->name}}</h3>

                    </div>
            <div class="ps-section__content pb-50">
                <div class="masonry-wrapper" data-col-md="4" data-col-sm="2" data-col-xs="1" data-gap="30" data-radio="100%">
                    <div class="ps-masonry">
                        <div class="grid-sizer"></div>
                        @foreach($products as $product)
                            <div class="grid-item kids">
                                <div class="grid-item__content-wrapper">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail">
                                            <div class="ps-badge"><span>New</span></div>
                                            <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-35%</span></div><a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a>
                                            <img height="350"  src="{{$product->image_link}}" alt="">
                                            <a class="ps-shoe__overlay" href="{{route('website.show',$product->slug)}}"></a>
                                        </div>
                                        <div class="ps-shoe__content">
                                            <div class="ps-shoe__variants">
                                                <div class="ps-shoe__variant normal">
                                                    @foreach($product->images as $image)
                                                        <img src="{{$image->image_link}}" alt="">
                                                    @endforeach
                                                </div>
                                                <select class="ps-rating ps-shoe__rating">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                </select>
                                            </div>

                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">{{$product->name}}</a>
                                                <p class="ps-shoe__categories"><a href="#">{{$product->category->name}}</a>,<a href="#"> {{$product->store->name}}</a></p><span class="ps-shoe__price">
                                            <del>$ {{$product->price}}</del> $ {{$product->sale_price}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
                </div>
            </div>
    </main>
@endsection

