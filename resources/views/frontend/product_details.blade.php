@extends('frontend.layouts.app')


@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="product" /> 
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />   
@endsection

@section('content') 


<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                        <li><a href="{{ route('products') }}">{{__('All Categories')}}</a></li>
                        @if(($detailedProduct->subsubcategory_id))
                            <li ><a href="{{ route('products.category', \App\SubSubCategory::find($detailedProduct->subsubcategory_id)->subcategory->category->slug) }}">{{ \App\SubSubCategory::find($detailedProduct->subsubcategory_id)->subcategory->category->name }}</a></li>
                            <li ><a href="{{ route('products.subcategory', \App\SubsubCategory::find($detailedProduct->subsubcategory_id)->subcategory->slug) }}">{{ \App\SubsubCategory::find($detailedProduct->subsubcategory_id)->subcategory->name }}</a></li>
                            <li class="active"><a href="{{ route('products.subsubcategory', \App\SubSubCategory::find($detailedProduct->subsubcategory_id)->slug) }}">{{ \App\SubSubCategory::find($detailedProduct->subsubcategory_id)->name }}</a></li>
                        @elseif(($detailedProduct-> subcategory_id))
                            <li ><a href="{{ route('products.category', \App\SubCategory::find($detailedProduct->subcategory_id)->category->slug) }}">{{ \App\SubCategory::find($detailedProduct->subcategory_id)->category->name }}</a></li>
                            <li class="active"><a href="{{ route('products.subcategory', \App\SubCategory::find($detailedProduct->subcategory_id)->slug) }}">{{ \App\SubCategory::find($detailedProduct->subcategory_id)->name }}</a></li>
                        @elseif(($detailedProduct->category_id))
                            <li class="active"><a href="{{ route('products.category', \App\Category::find($detailedProduct->category_id)->slug) }}">{{ \App\Category::find($detailedProduct->category_id)->name }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->



<!--shop  area start-->
<div class="shop_area shop_reverse mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="product_right_sidebar">
                    <div class="row"> 
                        <div class="col-lg-6 col-md-6">
                            <div class="product-details-tab">
                               @if(is_array(json_decode($detailedProduct->photos)) && count(json_decode($detailedProduct->photos)) > 0)
                                    <div id="img-1" class="zoomWrapper single-zoom">
                                        <a href="#">
                                            <img id="zoom1" src="{{ asset(json_decode($detailedProduct->photos)[0]) }}" data-zoom-image="{{ asset(json_decode($detailedProduct->photos)[0]) }}" alt="big-1">  
                                        </a>
                                    </div>
                                    <div class="single-zoom-thumb">
                                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                            @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                                            <li>
                                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{ asset($photo) }}" data-zoom-image="{{ asset($photo) }}">
                                                    <img src="{{ asset($photo) }}" alt="zo-th-1"/>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="product_d_right">

                                    <h1>{{ __($detailedProduct->name) }}</h1>
                                     <div class="row align-items-center my-1">
		                                <div class="col-6">
		                                    <!-- Rating stars -->
		                                    <div class="rating">
		                                        @php
		                                            $total = 0;
		                                            $total += $detailedProduct->reviews->count();
		                                        @endphp
		                                        <span class="star-rating">
		                                            {{ renderStarRating($detailedProduct->rating) }}
		                                        </span>
		                                        <span class="rating-count ml-1">({{ $total }} {{__('reviews')}})</span>
		                                    </div>
		                                </div>
		                                <div class="col-6 text-right">
		                                    <ul class="inline-links inline-links--style-1">
		                                        @php
		                                            $qty = 0;
		                                            if($detailedProduct->variant_product){
		                                                foreach ($detailedProduct->stocks as $key => $stock) {
		                                                    $qty += $stock->qty;
		                                                }
		                                            }
		                                            else{
		                                                $qty = $detailedProduct->current_stock;
		                                            }
		                                        @endphp
		                                        @if ($qty > 0)
		                                            <li>
		                                                <span class="badge badge-md badge-pill badge-success">{{__('In stock')}}</span>
		                                            </li>
		                                        @else
		                                            <li>
		                                                <span class="badge badge-md badge-pill  badge-danger">{{__('Out of stock')}}</span>
		                                            </li>
		                                        @endif
		                                    </ul>
		                                </div>
                                    </div>
                                    <div class="price_box">
                                        @if(home_price($detailedProduct->id) != home_discounted_price($detailedProduct->id))
                                       <div class="row no-gutters mt-4">
			                                    <div class="col-2">
			                                        <div class="product-description-label">{{__('Price')}}:</div>
			                                    </div>
			                                    <div class="col-10">
			                                        <span class="old_price">
			                                            <del>
			                                                {{ home_price($detailedProduct->id) }}
			                                                <span>/{{ $detailedProduct->unit }}</span>
			                                            </del>
			                                        </span>
			                                    </div>
			                                </div>

			                                <div class="row no-gutters mt-3">
			                                    <div class="col-2">
			                                        <div class="product-description-label mt-1">{{__('Discount Price')}}:</div>
			                                    </div>
			                                    <div class="col-10">
			                                        <span class="current_price">
			                                            <strong>
			                                                {{ home_discounted_price($detailedProduct->id) }}
			                                            </strong>
			                                            <span class="piece">/{{ $detailedProduct->unit }}</span>
			                                        </span>
			                                    </div>
			                                </div>
                                         @else
                                       <div class="row no-gutters mt-3">
		                                    <div class="col-2">
		                                        <div class="product-description-label">{{__('Price')}}:</div>
		                                    </div>
		                                    <div class="col-10">
		                                        <span class="current_price">
		                                            <strong>
		                                                {{ home_discounted_price($detailedProduct->id) }}
		                                            </strong>
		                                            <span class="piece">/{{ $detailedProduct->unit }}</span>
		                                        </span>
		                                    </div>
		                                </div>
                                         @endif
                                    </div>

                                    <hr>

                                   <form  id="option-choice-form"> 
                                          @csrf

                                    <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

                                     
                                     @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)

		                                <div class="row no-gutters">
		                                    <div class="col-2">
		                                        <div class="product-description-label mt-2 ">{{ \App\Attribute::find($choice->attribute_id)->name }}:</div>
		                                    </div>
		                                    <div class="col-10">
		                                        <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
		                                            @foreach ($choice->values as $key => $value)
		                                                <li>
		                                                    <input type="radio" id="{{ $choice->attribute_id }}-{{ $value }}" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if($key == 0) checked @endif>
		                                                    <label for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
		                                                </li>
		                                            @endforeach
		                                        </ul>
		                                    </div>
		                                </div>

		                              @endforeach

		                        @if (count(json_decode($detailedProduct->colors)) > 0)
                                    <div class="row no-gutters">
                                        <div class="col-2">
                                            <div class="product-description-label mt-2">{{__('Color')}}:</div>
                                        </div>
                                        <div class="col-10">
                                            <ul class="list-inline checkbox-color mb-1">
                                                @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                    <li>
                                                        <input type="radio" id="{{ $detailedProduct->id }}-color-{{ $key }}" name="color" value="{{ $color }}" @if($key == 0) checked @endif>
                                                        <label style="background: {{ $color }};" for="{{ $detailedProduct->id }}-color-{{ $key }}" data-toggle="tooltip"></label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                     <hr>
                                @endif  


                                    <div class="product_variant quantity">
                                        <label>quantity</label>
                                        <input min="1" max="100" value="1" type="number" name="quantity">
                                         <div class="avialable-amount" style="font-size: 13px;color: #777;overflow: hidden;text-overflow: ellipsis;">
                                         	(<span id="available-quantity" >{{ $qty }}</span> {{__('available')}})
                                         </div>
                                    </div>
                                    <hr>

                                  <div class="row no-gutters pb-3" id="chosen_price_div">
                                    <div class="col-4">
                                        <div class="product-description-label">{{__('Total Price')}} :</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="product-price " >
                                            <strong id="chosen_price">

                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                 </form>

                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart"><a title="Add to Cart" onclick="addToCart()"><i class="zmdi zmdi-shopping-cart-plus"></i> Add To Cart</a></li>
                                            <li class="wishlist"><a title="Add to Wishlist" onclick="addToWishList({{ $detailedProduct->id }})"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                            <li class="compare"><a title="compare" onclick="addToCompare({{ $detailedProduct->id }})"><i class="zmdi zmdi-swap"></i></a></li>
                                        </ul>
                                    </div>
                                    <hr>

                            <div class="row no-gutters mt-3">
                                <div class="col-2">
                                    <div class="product-description-label alpha-6">{{__('Payment')}}:</div>
                                </div>
                                <div class="col-10">
                                    <ul class="inline-links">
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/visa.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/mastercard.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/maestro.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/paypal.png') }}" width="30" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset('frontend/images/icons/cards/cod.png') }}" width="30" class="lazyload">
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <hr class="mt-4">
                            <div class="row no-gutters mt-4">
                                <div class="col-2">
                                    <div class="product-description-label mt-2">{{__('Share')}}:</div>
                                </div>
                                <div class="col-10">
                                    <div id="share"></div>
                                </div>
                            </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!--product info start-->
                <div class="product_d_info sidebar">
                    <div class="product_d_inner ">
                        <div class="product_info_button">
                            <ul class="nav" role="tablist">
                                <li >
                                    <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                                </li>
                                 @if($detailedProduct->video_link != null)
                                <li>
                                    <a data-toggle="tab" href="#video" role="tab" aria-controls="sheet" aria-selected="false">video</a>
                                </li>
                                 @endif

                                @if($detailedProduct->pdf != null)
                                <li>
                                    <a href="#tab_default_3" data-toggle="tab" aria-controls="sheet" aria-selected="false">{{__('Downloads')}}</a>
                                </li>
                                @endif

                                @php
                                    $total = 0;
                                    $total += $detailedProduct->reviews->count();
                                @endphp
                                <li>
                                    <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews ({{$total}})</a>
                                </li>
                                

                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" >
                                <div class="product_info_content">
                                   {!!  $detailedProduct->description !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="video" role="tabpanel" > 
                            
                                <div class="product_info_content">
                                      @if ($detailedProduct->video_provider == 'youtube' && $detailedProduct->video_link != null)
                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $detailedProduct->video_link)[1] }}"></iframe>
                                        @elseif ($detailedProduct->video_provider == 'dailymotion' && $detailedProduct->video_link != null)
                                            <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                        @elseif ($detailedProduct->video_provider == 'vimeo' && $detailedProduct->video_link != null)
                                            <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                        @endif
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab_default_3">
                                <div class="py-2 px-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ asset($detailedProduct->pdf) }}">{{ __('Download') }}</a>
                                        </div>
                                    </div>
                                    <span class="space-md-md"></span>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="reviews" role="tabpanel" >
                                <div class="reviews_wrapper">
                                
                                    @foreach ($detailedProduct->reviews as $key => $review)
                                     <h2>{{$total}} review for {{ __($detailedProduct->name) }}</h2>

                                    <div class="reviews_comment_box">
                                        <div class="comment_thmb">
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($review->user->avatar_original) }}" style="height: 50px;">
                                        </div>
                                        <div class="comment_text">
                                            <div class="reviews_meta">
                                                <div class="star_rating">
                                                  <ul>
                                                        @for($i=0; $i < $review->rating; $i++)
                                                            <i class="fa fa-star active"></i>                                                 
                                                        @endfor
                                                        @for ($i=0; $i < 5-$review->rating; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                   </ul>
                                                </div>
                                                <p><strong>{{ $review->user->name }} </strong>- {{ date('F d, Y', strtotime($review->created_at)) }}</p>
                                                <span>{{$review->comment}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach

                                    @if(count($detailedProduct->reviews) <= 0)
                                        <div class="text-center">
                                            {{ __('There have been no reviews for this product yet.') }}
                                        </div>
                                    @endif


                                  <!--   <div class="comment_title">
                                        <h2>Add a review </h2>
                                        <p>Your email address will not be published.  Required fields are marked </p>
                                    </div>
                                    <div class="product_ratting mb-10">
                                        <h3>Your rating</h3>
                                        <ul>
                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        </ul>
                                    </div> -->

                                   <!--  <div class="product_review_form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="review_comment">Your review </label>
                                                    <textarea name="comment" id="review_comment" ></textarea>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <label for="author">Name</label>
                                                    <input id="author"  type="text">

                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <label for="email">Email </label>
                                                    <input id="email"  type="text">
                                                </div>
                                            </div>
                                            <button type="submit">Submit</button>
                                        </form>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--product info end-->

                <!--product area start-->
                <div class="product_area related_products mb-47">  
                    <div class="section_title">
                        <h2>Related Products</h2>
                    </div>
                    <div class="product_carousel product_column3 owl-carousel">

                         @foreach (filter_products(\App\Product::where('subcategory_id', $detailedProduct->subcategory_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $related_product)
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a href="{{ route('product', $related_product->slug) }}"><img src="{{ asset($related_product->thumbnail_img) }}" alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3 class="text-truncate" style="padding-left: 10px;padding-right: 10px;"><a href="{{ route('product', $related_product->slug) }}">{{ __($related_product->name) }}</a></h3>
                                    </div>
                                    <div class="price_box">
                                         @if(home_base_price($related_product->id) != home_discounted_base_price($related_product->id))
                                          <span class="old_price">{{ home_base_price($related_product->id) }}</span>
                                          @endif
                                        <span class="current_price">{{ home_discounted_base_price($related_product->id) }}</span>
                                    </div>
                                </div>
                            </div>

                        @endforeach 
                       
                    </div>
                </div>
                <!--product area end-->
            </div>
            <div class="col-lg-3 col-md-12">
                <!--sidebar widget start-->
                <aside class="sidebar_widget sticky-top">
                    <div class="quick-contact">
                      Sold by:

                        @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                            <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}">{{ $detailedProduct->user->shop->name }}</a>
                        @else
                            {{ __('Inhouse product') }}
                        @endif

                        @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                                <div class="mt-4">
                                    <a class="quick-contact-btn" onclick="show_chat_modal()"><i class="zmdi zmdi-email"></i>{{__('Message Seller')}}</a>
                                </div>
                        @endif

                    </div>

                    <div class="vendor-info">

                         <div class="sold-by position-relative">
                            @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1 && $detailedProduct->user->seller->verification_status == 1)
                                <div class="position-absolute medal-badge">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" viewBox="0 0 287.5 442.2">
                                        <polygon style="fill:#F8B517;" points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 "/>
                                        <circle style="fill:#FBD303;" cx="143.8" cy="143.8" r="143.8"/>
                                        <circle style="fill:#F8B517;" cx="143.8" cy="143.8" r="93.6"/>
                                        <polygon style="fill:#FCFCFD;" points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3
                                        60,116.6 124.1,116.6 "/>
                                    </svg>
                                </div>
                            @endif
                            <div class="title">{{__('Sold By')}}</div>
                            @if($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="name d-block">{{ $detailedProduct->user->shop->name }}
                                @if ($detailedProduct->user->seller->verification_status == 1)
                                    <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                                @else
                                    <span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>
                                @endif
                                </a>
                                <div class="location">{{ $detailedProduct->user->shop->address }}</div>
                            @else
                                {{ env('APP_NAME') }}
                            @endif
                            @php
                                $total = 0;
                                $rating = 0;
                                foreach ($detailedProduct->user->products as $key => $seller_product) {
                                    $total += $seller_product->reviews->count();
                                    $rating += $seller_product->reviews->sum('rating');
                                }
                            @endphp

                            <div class="rating text-center d-block">
                                <span class="star-rating star-rating-sm d-block">
                                    @if ($total > 0)
                                        {{ renderStarRating($rating/$total) }}
                                    @else
                                        {{ renderStarRating(0) }}
                                    @endif
                                </span>
                                <span class="rating-count d-block ml-0">({{ $total }} {{__('customer reviews')}})</span>
                            </div>
                        </div>

                         <div class="row no-gutters align-items-center">
                            @if($detailedProduct->added_by == 'seller')
                                <div class="col">
                                    <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="d-block store-btn">{{__('Visit Store')}}</a>
                                </div>
                                <div class="col">
                                    <ul class="social-media social-media--style-1-v4 text-center">
                                        <li>
                                            <a href="{{ $detailedProduct->user->shop->facebook }}" class="facebook" target="_blank" data-toggle="tooltip" data-original-title="Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $detailedProduct->user->shop->google }}" class="google" target="_blank" data-toggle="tooltip" data-original-title="Google">
                                                <i class="fa fa-google"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $detailedProduct->user->shop->twitter }}" class="twitter" target="_blank" data-toggle="tooltip" data-original-title="Twitter">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $detailedProduct->user->shop->youtube }}" class="youtube" target="_blank" data-toggle="tooltip" data-original-title="Youtube">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                    </div>
                </aside>
                <!--sidebar widget end-->
            </div>

        </div>
    </div>
</div>
<!--shop  area end-->


<div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{__('Any question about this product?')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="Product Name" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="Your Question">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{__('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script type="text/javascript">
         $(document).ready(function() {
            $('#share').share({
                networks: ['facebook','twitter','linkedin','tumblr','in1','stumbleupon','digg'],
                theme: 'square'
            });
            getVariantPrice();

        });

        function CopyToClipboard(containerid) {
            if (document.selection) {
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("Copy");

            } else if (window.getSelection) {
                var range = document.createRange();
                document.getElementById(containerid).style.display = "block";
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("Copy");
                document.getElementById(containerid).style.display = "none";

            }
            showFrontendAlert('success', 'Copied');
        }

        function show_chat_modal(){
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }

    </script>
@endsection