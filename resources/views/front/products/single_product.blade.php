
@extends('front.layouts.master')
@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li>product details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<div class="product_page_bg">
    <div class="container">
        <!--product details start-->
        <div class="product_details">
            <div class="row">
                <div class="col-lg-5 col-md-6">

                         @php
                                    $photos = json_decode($detailedProduct->photos);

                                    $image1 = $image2 = null;

                                    if(key_exists(0, $photos))
                                        $image1 = $photos['0'];

                                    if(key_exists(1, $photos))
                                        $image2 = $photos['1'];
                                    else
                                        $image2 = $image1;

                                    @endphp     
                    <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            

            
                            <a href="#">

                                <img id="zoom1" src="{{ asset($image1) }}" data-zoom-image="{{ asset($image2) }}" alt="big-1">
                            </a>
                        </div>
                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">@if(is_array(json_decode($detailedProduct->photos)))

                                  @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                                <li>
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{ asset($photo) }}" data-zoom-image="{{ asset($photo) }}">
                                        <img src="{{ asset($photo) }}" alt="zo-th-1"/>
                                    </a>

                                </li>
                                @endforeach
                                @endif

                             
                             

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="product_d_right">
                       
  <form  id="option-choice-form"> 
                                          @csrf

                                    <input type="hidden" name="id" value="{{ $detailedProduct->id }}">
                           
                                 </form>
                        <form action="#">

                            <h3><a href="#">{{ $detailedProduct->name }}</a></h3>

                            <div class="product_rating">
                                <ul>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                    <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                    <li class="review"><a href="#">(1 customer review )</a></li>
                                </ul>
                            </div>
                            <div class="price_box">
                                <span class="old_price">${{ $detailedProduct->unit_price }}</span>
                                <span class="current_price">${{ $detailedProduct->purchase_price }}</span>
                            </div>
                            <div class="product_desc">
                                <!-- <p>{!! $detailedProduct->description !!} </p> -->
                            </div>
                            <div class="product_variant color">
                                <h3>Available Options</h3>
                                <label>color</label>
                                <ul>
                                    <li class="color1"><a href="#"></a></li>
                                    <li class="color2"><a href="#"></a></li>
                                    <li class="color3"><a href="#"></a></li>
                                    <li class="color4"><a href="#"></a></li>
                                </ul>
                            </div>
                            <div class="product_variant quantity">
                                <label>quantity</label>

                                <input min="1" max="100" value="1" type="number">
                                    <a onclick="addToCart()" title="Add to cart" class="btn btn-warning">Add to cart</a>

                    

                            </div>

                            <div class="product_meta">
                                <span>Category: <a href="#">@if(!empty($detailedProduct->category)){{ $detailedProduct->category->name }}@endif
                                  
                                </a></span>
                            </div>

                        </form>
                        <div class="priduct_social">
                            <ul>
                                <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i> Like</a></li>
                                <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i> tweet</a></li>
                                <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i> save</a></li>
                                <li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i> share</a></li>
                                
                           </ul>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
        <!--product details end-->

        <!--product info start-->
        <div class="product_d_info">
            <div class="row">
                <div class="col-12">
                    <div class="product_d_inner">
                        <div class="product_info_button">
                            <ul class="nav" role="tablist">
                                <li >
                                    <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Specification</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews (1)</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" >
                                <div class="product_info_content">
                                    <p> 
                                       {!! $detailedProduct->description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sheet" role="tabpanel" >
                                <div class="product_d_table">
                                    <form action="#">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="first_child">Compositions</td>
                                                <td>Polyester</td>
                                            </tr>
                                            <tr>
                                                <td class="first_child">Styles</td>
                                                <td>Girly</td>
                                            </tr>
                                            <tr>
                                                <td class="first_child">Properties</td>
                                                <td>Short Dress</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="product_info_content">
                                    <p>{!! $detailedProduct->description !!}</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="reviews" role="tabpanel" >
                              



                            <div class="reviews_wrapper">
                                   @foreach ($detailedProduct->reviews as $key => $review)
                                     <h2> review for {{ __($detailedProduct->name) }}</h2>

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
                                    @foreach ($detailedProduct->reviews as $key => $review)
                                     <h2>
                                          review for {{ __($detailedProduct->name) }}</h2>

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
            </div>
        </div>
        <!--product info end-->

        <!--product area start-->
        <section class="product_area related_products">
            <div class="row">
                <div class="col-12">
                    <div class="section_title title_style2">
                        <div class="title_content">
                            <h2><span>Related</span> Products</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product_carousel product_details_column5 owl-carousel">
                       @foreach (filter_products(\App\Product::where('subcategory_id', $detailedProduct->subcategory_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $related_product)

                                   

                                   @php
                                    $photos = json_decode($related_product->photos);

                                    $image1 = $image2 = '';

                                    if(!empty($photos)){
                                    if(key_exists(0, $photos))
                                        $image1 = $photos['0'];

                                    if(key_exists(1, $photos))
                                        $image2 = $photos['1'];
                                    else
                                        $image2 = $image1;
                                     }

                                    @endphp                       
                               <div class="col-lg-3">
                                   <div class="product_items">
                                   
                                        <article class="single_product">
                                            <figure>
                                                <div class="product_thumb">
                                                    <a class="primary_img" href="{{ route('product', $related_product->slug) }}"><img src="{{ asset($image1) }}" alt=""></a>
                                                    <a class="secondary_img" href="{{ route('product', $related_product->slug) }}"><img src="{{ asset($image2) }}" alt=""></a>
                                                </div>
                                                <div class="product_content">
                                                    <div class="product_content_inner">
                                    <p class="manufacture_product"><a href="#">{{ $related_product->name }}</a></p>
                                                        <h4 class="product_name"><a href="{{ route('product', $related_product->slug) }}">
           
                                                        </a></h4>
                                                        <div class="product_rating">
                                                           <ul>
                                                               <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                               <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                               <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                               <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                               <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                           </ul>
                                                        </div>
                                                        <div class="price_box"> 

                                                            <span class="current_price">
                                                            {{ $related_product->purchase_price }}
                                                        </span>
                                                        </div>
                                                    </div> 
                                                    <div class="action_links">
                                                         <ul>
                                                            <li class="add_to_cart"><a href="#" title="Add to cart">Add to cart</a></li>

                                                        </ul>
                                                    </div>  
                                                </div>
                                            </figure>
                                        </article>
                                
                                        

                                    </div>
                               </div>
                                   @endforeach

                </div>
            </div>
        </section>
        <!--product area end-->


    </div>
</div>
<script type="text/javascript">
      $(document).ready(function() {
            $('#share').share({
                networks: ['facebook','twitter','linkedin','tumblr','in1','stumbleupon','digg'],
                theme: 'square'
            });
            getVariantPrice();

        });
</script>

@endsection