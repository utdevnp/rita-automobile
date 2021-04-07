@extends('frontend.layouts.app')

@section('meta_title'){{ $shop->meta_title }}@stop

@section('meta_description'){{ $shop->meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $shop->meta_title }}">
    <meta itemprop="description" content="{{ $shop->meta_description }}">
    <meta itemprop="image" content="{{ asset($shop->logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $shop->meta_title }}">
    <meta name="twitter:description" content="{{ $shop->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($shop->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $shop->meta_title }}" />
    <meta property="og:type" content="Shop" />
    <meta property="og:url" content="{{ route('shop.visit', $shop->slug) }}" />
    <meta property="og:image" content="{{ asset($shop->logo) }}" />
    <meta property="og:description" content="{{ $shop->meta_description }}" />
    <meta property="og:site_name" content="{{ $shop->name }}" />
@endsection

@section('content')
    <!-- <section>
        <img loading="lazy"  src="https://via.placeholder.com/2000x300.jpg" alt="" class="img-fluid">
    </section> -->

    @php
        $total = 0;
        $rating = 0;
        foreach ($shop->user->products as $key => $seller_product) {
            $total += $seller_product->reviews->count();
            $rating += $seller_product->reviews->sum('rating');
        }
    @endphp

    <section class="gry-bg pt-4 ">
        <div class="container">
            <div class="row align-items-baseline">
                <div class="col-md-6">
                    <div class="d-flex">
                        <img
                            class="lazyload"
                            src="{{ asset('frontend/images/placeholder.jpg') }}"
                            data-src="@if ($shop->logo !== null) {{ asset($shop->logo) }} @else {{ asset('frontend/images/placeholder.jpg') }} @endif"
                            alt="{{ $shop->name }}" style="width:auto;height:70px;">
                        <div class="pl-4">
                            <h3 class="strong-700 heading-4 mb-0">{{ $shop->name }}
                                @if ($shop->user->seller->verification_status == 1)
                                    <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                                @else
                                    <span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>
                                @endif
                            </h3>
                            <div class="star-rating star-rating-sm mb-1">
                                @if ($total > 0)
                                    {{ renderStarRating($rating/$total) }}
                                @else
                                    {{ renderStarRating(0) }}
                                @endif
                            </div>
                            <div class="location alpha-6">{{ $shop->address }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="text-md-right mt-4 mt-md-0 social-nav model-2">
                        @if ($shop->facebook != null)
                            <li>
                                <a href="{{ $shop->facebook }}" class="facebook social_a" target="_blank" data-toggle="tooltip" data-original-title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if ($shop->twitter != null)
                            <li>
                                <a href="{{ $shop->twitter }}" class="twitter social_a" target="_blank" data-toggle="tooltip" data-original-title="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if ($shop->google != null)
                            <li>
                                <a href="{{ $shop->google }}" class="google-plus social_a" target="_blank" data-toggle="tooltip" data-original-title="Google">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        @endif
                        @if ($shop->youtube != null)
                            <li>
                                <a href="{{ $shop->youtube }}" class="youtube social_a" target="_blank" data-toggle="tooltip" data-original-title="Youtube">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white">
        <div class="container">
            <div class="row sticky-top mt-4">
                <div class="col">
                    <div class="seller-shop-menu">
                        <ul class="inline-links">
                            <li @if(!isset($type)) class="active" @endif><a href="{{ route('shop.visit', $shop->slug) }}">{{__('Store Home')}}</a></li>
                            <li @if(isset($type) && $type == 'top_selling') class="active" @endif><a href="{{ route('shop.visit.type', ['slug'=>$shop->slug, 'type'=>'top_selling']) }}">{{__('Top Selling')}}</a></li>
                            <li @if(isset($type) && $type == 'all_products') class="active" @endif><a href="{{ route('shop.visit.type', ['slug'=>$shop->slug, 'type'=>'all_products']) }}">{{__('All Products')}}</a></li>
                        </ul>  
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (!isset($type))
        <section class="py-4">
            <div class="container">   
               <!--  <div class="home-slide">
                    <div class="slick-carousel" data-slick-arrows="true" data-slick-dots="true">
                        @if ($shop->sliders != null)
                            @foreach (json_decode($shop->sliders) as $key => $slide)
                                <div class="">
                                    <img class="d-block w-100 lazyload" src="{{ asset('frontend/images/placeholder-rect.jpg') }}" data-src="{{ asset($slide) }}" alt="{{ $key }} slide" style="max-height:300px;">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div> -->

                <div class="row">
                    <div class="col">
                        <div class="slider_area slider_two owl-carousel">

                           @if ($shop->sliders != null)
                            @foreach (json_decode($shop->sliders) as $key => $slide)
                            <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset($slide) }}">
                                <div class="slider_content slider_content_two content_position_center">
                                </div>
                            </div>
                            @endforeach
                            @Endif
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section class="sct-color-1 pt-5 pb-4">
            <div class="container">
                <div class="section-title section-title--style-1 text-center mb-4">
                    <h3 class="section-title-inner heading-3 strong-600">
                        {{__('Featured Products')}}
                    </h3>
                </div>
                <div class="row">
                    <div class="col">
                       <div class="row no-gutters shop_wrapper">
                            @foreach ($shop->user->products->where('published', 1)->where('featured', 1) as $key => $product)

                             <div class="col-lg-3 col-md-4 col-6 ">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a href="{{ route('product', $product->slug) }}"><img src="{{ asset($product->thumbnail_img) }}"  alt="{{ __($product->name) }}"></a>
                                    </div>
                                    <div class="product_content grid_content">
                                        <div class="product_name">
                                            <h3><a href="{{ route('product', $product->slug) }}" class="text-truncate" style="display: block;padding-left:10px;padding-right: 10px;">{{ __($product->name) }}</a></h3>
                                        </div>
                                        <div class="price_box">
                                             @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                                <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                             @endif
                                             <span class="current_price">{{ home_discounted_base_price($product->id) }}</span>       
                                        </div>
                                    </div>
                                    <div class="product_content list_content">
                                        <div class="product_name">
                                            <h3><a href="{{ route('product', $product->slug) }}" style="display: block;">{{ __($product->name) }}</a></h3>
                                        </div>

                                        <div class="price_box">
                                             @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                                <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                             @endif
                                             <span class="current_price">{{ home_discounted_base_price($product->id) }}</span> 

                                        </div>


                                        <div class="product_desc">
                                            <p>{! __($product->description) !}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            @endforeach                           
                    </div>
                </div>
            </div>
          </div>
        </section>
    @endif


    <section class="@if (!isset($type)) gry-bg @endif pt-5">
        <div class="container">
            <h4 class="heading-5 strong-600 border-bottom pb-3 mb-4">
                @if (!isset($type))
                    {{__('New Arrival Products')}}
                @elseif ($type == 'top_selling')
                    {{__('Top Selling')}}
                @elseif ($type == 'all_products')
                    {{__('All Products')}}
                @endif
            </h4>
            
                @php
                    if (!isset($type)){
                        $products = \App\Product::where('user_id', $shop->user->id)->where('published', 1)->orderBy('created_at', 'desc')->paginate(24);
                    }
                    elseif ($type == 'top_selling'){
                        $products = \App\Product::where('user_id', $shop->user->id)->where('published', 1)->orderBy('num_of_sale', 'desc')->paginate(24);
                    }
                    elseif ($type == 'all_products'){
                        $products = \App\Product::where('user_id', $shop->user->id)->where('published', 1)->paginate(24);
                    }
                @endphp

                <div class="row no-gutters shop_wrapper">

                @foreach ($products as $key => $product)
                   <div class="col-lg-3 col-md-4 col-6 ">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a href="{{ route('product', $product->slug) }}"><img src="{{ asset($product->thumbnail_img) }}"  alt="{{ __($product->name) }}"></a>
                            </div>
                            <div class="product_content grid_content">
                                <div class="product_name">
                                    <h3><a href="{{ route('product', $product->slug) }}" class="text-truncate" style="display: block;padding-left:10px;padding-right: 10px;">{{ __($product->name) }}</a></h3>
                                </div>
                                <div class="price_box">
                                     @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                     @endif
                                     <span class="current_price">{{ home_discounted_base_price($product->id) }}</span>       
                                </div>
                            </div>
                            <div class="product_content list_content">
                                <div class="product_name">
                                    <h3><a href="{{ route('product', $product->slug) }}" style="display: block;">{{ __($product->name) }}</a></h3>
                                </div>

                                <div class="price_box">
                                     @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                     @endif
                                     <span class="current_price">{{ home_discounted_base_price($product->id) }}</span> 

                                </div>


                                <div class="product_desc">
                                    <p>{! __($product->description) !}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
               

            </div>
            <div class="row">
                <div class="col">
                    <div class="products-pagination my-5">
                        <nav aria-label="Center aligned pagination">
                            <ul class="pagination justify-content-center">
                                {{ $products->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    


@endsection




