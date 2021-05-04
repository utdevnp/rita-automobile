@extends('front.layouts.master')
@section('content')

  <!--top tags area start-->
  <div class="top_tags_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tags_content">
                        <ul>
                            <li><span>Top Tags:</span></li>
                             
                          




    @foreach ($values as $value)
    @php
    $slug=App\Product::where('slug',$value)->first();
     
     
   
   
@endphp

                 <li><a href="{{ url('/tag',$slug) }}">{{ $value }}</a></li>
                            
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--top tags area end-->

    <!--slider area start-->
    <section class="slider_section mb-80">
        <div class="slider_area slider_carousel owl-carousel">
                 @foreach (\App\Slider::where('published', 1)->get() as $key => $slider)
            <div class="single_slider    d-flex align-items-center"data-bgimg="{{ asset($slider->photo) }}">
               <div class="container">
                   <div class="row">
                       <div class="col-12">
                           <div class="slider_content">
                                <h1>Big sale off <span>Accessories Fidanza</span></h1>
                                <p>Exclusive Offer -30% Off This Week</p>  
                                <a class="button" href="shop.html">shopping now <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                            </div>
                       </div>
                   </div>
               </div> 
            </div>
            @endforeach
        
        </div>
    </section>
    <!--slider area end-->

    <!--Categories product area start-->
    <div class="categories_product_area mb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="categories_product_inner categories_column7 owl-carousel">
                            @foreach (App\Category::all()->take(8) as $key => $category)
                <div class="single_categories_product">
                    <div class="categories_product_thumb homepage_product_cat">
                        <a href="{{ route('products.category', $category->slug) }}"><img src="{{ asset($category->icon) }}" alt=""></a>
                    </div>
                    <div class="categories_product_content">
                        <h4><a href="{{ route('products.category', $category->slug) }}">{{ $category->name }}</a></h4>
                    </div>
                   
                </div>
                 @endforeach
         
            </div>
                </div>
            </div>
        </div>
    </div>
    <!--Categories product area end-->

    <!--home section bg area start-->
    <div class="home_section_bg">
        <!--product area start-->
        <div class="product_area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_title">
                           <h2><span>our</span> Products</h2>
                            <p>Consectetuer sociis mauris eu augue velit pulvinar ullamcorper 
                                in ac mauris ac vel, interdum sed malesuada curae sit amet non nec quis arcu massa. </p>                    
                        </div>
                        <div class="product_tab_btn">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#Sellers" role="tab" aria-controls="Sellers" aria-selected="true"> 
                                        Best Sellers
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#Featured" role="tab" aria-controls="Featured" aria-selected="false">
                                        Featured Products
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#Arrivals" role="tab" aria-controls="Arrivals" aria-selected="false">
                                       New Arrivals
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> 
                <div class="tab-content">


                    <div class="tab-pane fade show active" id="Sellers" role="tabpanel">
                        <div class="row">


                            <div class="product_carousel product_column5 owl-carousel">
                              @php
                              $bsp = App\Product::where('num_of_sale', '>', '0')->where('published', 1)->orderBy('num_of_sale', 'desc')->get();
                              $counter = 0;
                              @endphp

                              @foreach($bsp as $product)

                              @php
                              $photos = json_decode($product->photos);

                              $image1 = $image2 = '';

                              if(!empty($photos)){
                              if(key_exists(0, $photos))
                                  $image1 = $photos['0'];

                              if(key_exists(1, $photos))
                                  $image2 = $photos['1'];
                              else
                                  $image2 = $image1;
                               }

                               $counter++;
                           
                              @endphp 

                              @if($counter%2 != 0)
                               <div class="col-lg-3">
                                   <div class="product_items">
                                   @endif
                                        <article class="single_product">
                                            <figure>
                                                <div class="product_thumb">
                                                    <a class="primary_img" href="{{route("product",['slug'=>$product->slug])}}"><img src="{{ asset($image1) }}" alt=""></a>
                                                    <a class="secondary_img" href="{{route("product",['slug'=>$product->slug])}}"><img src="{{ asset($image2) }}" alt=""></a>
                                                </div>
                                                <div class="product_content">
                                                    <div class="product_content_inner">
                                                      <p class="manufacture_product"><a href="{{route("product",['slug'=>$product->slug])}}">{{ $product->name }}</a></p>
                                                        <h4 class="product_name"><a href="{{route("product",['slug'=>$product->slug])}}">
           
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



  @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <span class="current_price">
                                                           {{ home_base_price($product->id) }}
                                                           @endif
                                                        </span>


                                                        </div>
                                                    </div> 
                                                    <div class="action_links">
                                                         <ul>
                                   <li class="add_to_cart" ><a href="#" class="addIntoCart" value="{{$product->id}}"  onclick="classToCart(this)" title="Add to cart" >Add to cart</a></li>

                                                        </ul>
                                                    </div>  
                                                </div>
                                            </figure>
                                        </article>

                                        @if($counter%2 == 0)
                                      </div>
                                    </div>
                                    @endif

                                
                                
                                   <!--      <article class="single_product">
                                            <figure>
                                                <div class="product_thumb">
                                                    <a class="primary_img" href="product-details.html"><img src="" alt=""></a>
                                                    <a class="secondary_img" href="product-details.html"><img src="" alt=""></a>
                                                    <div class="label_product">
                                                        <span class="label_new">new</span>
                                                    </div>

                                                </div>
                                                <div class="product_content">
                                                    <div class="product_content_inner">
                                                        <p class="manufacture_product"><a href="#">Parts</a></p>
                                                        <h4 class="product_name"><a href="product-details.html">Mauris Vel Tellus</a></h4>
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
                                                            <span class="old_price">$420.00</span> 
                                                            <span class="current_price">$180.00</span>
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
                               </div> -->
                                   @endforeach

                      
                            </div> 



                        </div> 
                    </div>

                    <div class="tab-pane fade" id="Featured" role="tabpanel">
                        <div class="row">


                            <div class="product_carousel product_column5 owl-carousel">
                              @php
                              $featured_products = App\Product::where('featured','1')->where('published', 1)->orderBy('id', 'asc')->get();
                              $counter = 0;
                              @endphp

                              @foreach($featured_products as $featured_product)

                              @php
                              $photos = json_decode($featured_product->photos);

                              $image1 = $image2 = '';

                              if(!empty($photos)){
                              if(key_exists(0, $photos))
                                  $image1 = $photos['0'];

                              if(key_exists(1, $photos))
                                  $image2 = $photos['1'];
                              else
                                  $image2 = $image1;
                               }

                               $counter++;
                           
                              @endphp 

                              @if($counter%2 != 0)
                               <div class="col-lg-3">
                                   <div class="product_items">
                                   @endif
                                        <article class="single_product">
                                            <figure>
                                                <div class="product_thumb">
                                                    <a class="primary_img" href="{{route("product",['slug'=>$featured_product->slug])}}"><img src="{{ asset($image1) }}" alt=""></a>
                                                    <a class="secondary_img" href="{{route("product",['slug'=>$featured_product->slug])}}"><img src="{{ asset($image2) }}" alt=""></a>
                                                </div>
                                                <div class="product_content">
                                                    <div class="product_content_inner">
                                                      <p class="manufacture_product"><a href="{{route("product",['slug'=>$featured_product->slug])}}">{{ $featured_product->name }}</a></p>
                                                        <h4 class="product_name"><a href="{{route("product",['slug'=>$featured_product->slug])}}">
           
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
                                                            {{ $featured_product->purchase_price }}
                                                        </span>
                                                        </div>
                                                    </div> 
                                                    <div class="action_links">
                                                         <ul>
                                                            <li class="add_to_cart"><a href="#"  title="Add to cart">Add to cart</a></li>

                                                        </ul>
                                                    </div>  
                                                </div>
                                            </figure>
                                        </article>

                                        @if($counter%2 == 0)
                                      </div>
                                    </div>
                                    @endif

                                
                                
                                   @endforeach

                      
                            </div> 



                        </div> 
                    </div>

                    <div class="tab-pane fade" id="Arrivals" role="tabpanel">
                        <div class="row">


                            <div class="product_carousel product_column5 owl-carousel">
                              @php
                              $arrival_products = App\Product::where('published', 1)->orderBy('id', 'desc')->get();
                              $counter = 0;
                              @endphp

                              @foreach($arrival_products as $arrival_product)

                              @php
                              $photos = json_decode($arrival_product->photos);

                              $image1 = $image2 = '';

                              if(!empty($photos)){
                              if(key_exists(0, $photos))
                                  $image1 = $photos['0'];

                              if(key_exists(1, $photos))
                                  $image2 = $photos['1'];
                              else
                                  $image2 = $image1;
                               }

                               $counter++;
                           
                              @endphp 

                              @if($counter%2 != 0)
                               <div class="col-lg-3">
                                   <div class="product_items">
                                   @endif
                                        <article class="single_product">
                                            <figure>
                                                <div class="product_thumb">
                                                    <a class="primary_img" href="{{route("product",['slug'=>$arrival_product->slug])}}"><img src="{{ asset($image1) }}" alt=""></a>
                                                    <a class="secondary_img" href="{{route("product",['slug'=>$arrival_product->slug])}}"><img src="{{ asset($image2) }}" alt=""></a>
                                                </div>
                                                <div class="product_content">
                                                    <div class="product_content_inner">
                                                      <p class="manufacture_product"><a href="{{route("product",['slug'=>$arrival_product->slug])}}">{{ $arrival_product->name }}</a></p>
                                                        <h4 class="product_name"><a href="{{route("product",['slug'=>$arrival_product->slug])}}">
           
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
                                                            {{ $arrival_product->purchase_price }}
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

                                        @if($counter%2 == 0)
                                      </div>
                                    </div>
                                    @endif

                                
                                
                                   @endforeach

                      
                            </div> 



                        </div> 
                    </div>
                    


                
                    


                                       @if($counter%2 !=0)
                                      </div>
                                    </div>
                                    @endif
                </div> 

            </div>
        </div>
        <!--product area end-->
        
        <!--banner area start-->
        <div class="banner_area mb-80">
            <div class="container">
                <div class="row">
   
                     @foreach (App\Banner::where('position', 1)->where('published', 1)->get() as $banner)
                    <div class="col-lg-6 col-md-6">
                        <figure class="single_banner">
                            <div class="banner_thumb">
                                <a href="#"><img src="{{ asset($banner->photo) }}" alt=""></a>
                            </div>
                        </figure>
                    </div>
                        @endforeach
                </div>
            </div>
        </div>
        <!--banner area end-->
        
        <!--product area start-->
        <div class="product_area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_title title_style2">
                           <div class="title_content">
                               <h2><span>OnSale</span> Products</h2>
                                <p>The highest discount products of Mazlay </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_container">
                   <div class="row">

                
                        <div class="col-lg-6 col-md-12">
                          <div class="product_style_left">    

                                <article class="single_product">
                                    <figure>
                                    
                                        @foreach(App\FlashDealProduct::all()->take(1) as $flash_deal_product)
                                    
                                            
                                        @php 
                                        $product = App\Product::where('id',$flash_deal_product->product_id)->first();
                                        @endphp

                                        <div class="product_thumb">
                                                            <a class="primary_img" href="{{route("product",['slug'=>$flash_deal_product->slug])}}"><img src="{{ asset('frontend_assets/assets/img/product/product9.jpg') }}" alt=""></a>
                                                            <a class="secondary_img" href="{{route("product",['slug'=>$flash_deal_product->slug])}}"><img src="{{ asset('frontend_assets/assets/img/product/product10.jpg') }}" alt=""></a>
                                                            <div class="label_product">
                                                                <span class="label_sale">-
                                                                  {{ $flash_deal_product->discount }}
                                                       {{ $flash_deal_product->discount_type }}
                                                              </span>
                                                           
                                                           
                                                            </div>

                                                        </div>
                                        <div class="product_content">
                                            <p class="manufacture_product"><a href="#">
                                    
                                       

                                            </a></p>
                                            <h4 class="product_name"><a href="{{route("product",['slug'=>$flash_deal_product->slug])}}">{{ $product->name }}</a></h4>
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
                                                <span class="old_price">{{ $product->unit_price }}</span>
                                                <span class="current_price">$120.00</span>
                                            </div>
                                            <div class="product_desc">
                                                <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc.</p>
                                            </div>
                                            <div class="action_links">
                                                 <ul>
                                                    <li class="add_to_cart"><a href="#" title="Add to cart">Add to cart</a></li>

                                                </ul>
                                            </div>
                                        </div>

                                
                                    
                                        @endforeach
                                    </figure>
                                </article>


                            </div>
                        </div>
                       @php
                                 $flash_deal = App\FlashDeal::where('status', 1)->where('featured', 1)->first();
                                 
                              
                            

                              @endphp
                        <div class="col-lg-6 col-md-12">
                            <div class="product_style_right">
                                <div class="row">
                                    <div class="product_carousel product_column3 owl-carousel">
                                      



                
   
                                        @foreach($flash_deal->flash_deal_products as $key => $flash_deal_product)

                                     @php


                                      $flash_product = App\Product::find($flash_deal_product->product_id);
                                  
                                  

                                @endphp
                          
                        
                             
                       


                                        <div class="col-lg-3">
                                            <article class="single_product">
                                                    <figure>
                                                        <div class="product_thumb">
                                                            <a class="primary_img" href="{{route("product",['slug'=>$flash_product->slug])}}"><img src="{{ asset('frontend_assets/assets/img/product/product9.jpg') }}" alt=""></a>
                                                            <a class="secondary_img" href="{{route("product",['slug'=>$flash_product->slug])}}"><img src="{{ asset('frontend_assets/assets/img/product/product10.jpg') }}" alt=""></a>
                                                            <div class="label_product">
                                                                <span class="label_sale">-44%</span>
                                                            </div>

                                                        </div>
                                                        <div class="product_content">
                                                            <div class="product_content_inner">
                                                                <p class="manufacture_product"><a href="#">
                                                                   {{ $flash_product->name }}

                                                                </a></p>
                                                                <h4 class="product_name"><a href="{{route("product",['slug'=>$flash_product->slug])}}">Cas Meque Metus</a></h4>
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
                                                                    <span class="old_price">$420.00</span>
                                                                    <span class="current_price">$180.00</span>
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
                                     
                                        @endforeach 
                                         


                                  
                                    </div>
                                </div>
                            </div>
                        </div>

                   </div>

                </div>
            </div>
        </div>


        <!--product area end-->

     
    <!--home section bg area end-->
    
    <!--brand area start-->
<div class="brand_area brand_padding">
    <div class="container">
        <div class="col-12">
            <div class="brand_container owl-carousel ">
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand1.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand2.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand3.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand4.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand5.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand6.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand7.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand8.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand1.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand2.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand3.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand4.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="brand_list">
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand5.jpg') }}" alt=""></a>
                    </div>
                    <div class="single_brand">
                        <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand6.jpg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--brand area end-->

    <!--newsletter area start-->
    <div class="newsletter_area">
        <div class="container">
            <div class="newsletter_inner">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="newsletter_container">
                            <h3>Follow Us</h3>
                            <p>We make consolidating, marketing and tracking your social media website easy.</p>
                            <div class="footer_social">
                               <ul>
                                   <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                                   <li><a class="twitter" href="#"><i class="icon-twitter2"></i></a></li>
                                   <li><a class="rss" href="#"><i class="icon-rss"></i></a></li>
                                   <li><a class="youtube" href="#"><i class="icon-youtube"></i></a></li>
                                   <li><a class="google" href="#"><i class="icon-google"></i></a></li>
                                   <li><a class="instagram2" href="#"><i class="icon-instagram2"></i></a></li>
                               </ul>
                           </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="newsletter_container">
                            <h3>Newsletter Now</h3>
                            <p>Join 60.000+ subscribers and get a new discount coupon on every Wednesday.</p>
                            <div class="subscribe_form">
                                <form id="mc-form" class="mc-form footer-newsletter" >
                                    <input id="mc-email" type="email" autocomplete="off" placeholder="Enter you email address here..." />
                                    <button id="mc-submit">Subscribe</button>
                                </form>
                                <!-- mailchimp-alerts Start -->
                                <div class="mailchimp-alerts text-centre">
                                    <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                    <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                    <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                                </div><!-- mailchimp-alerts end -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-7">
                        <div class="newsletter_container col_3">
                            <h3>APP COMING SOON</h3>
                            <p>Rita Automobiles App will be available on Google Play & App Store. </p>
                            <div class="app_img">
                               <ul>
                                   <li><a href="#"><img src="{{ asset('frontend_assets/assets/img/icon/icon-app.jpg') }}" alt=""></a></li>
                                   <li><a href="#"><img src="{{ asset('frontend_assets/assets/img/icon/icon1-app.jpg') }}" alt=""></a></li>
                               </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--newsletter area end-->

@endsection


