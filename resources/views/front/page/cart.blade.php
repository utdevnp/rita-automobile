@extends('front.layouts.master')
@section('content')




<!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="">home</a></li>
                            <li>Shopping Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->
    
    <!--shopping cart area start -->
    <div class="cart_page_bg">
        <div class="container">
        
            <div class="shopping_cart_area">
            @if(Session::has('cart'))
                <form method="post" action="{{route('cart.updateQuantity')}}"> 
                    @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="table_desc">
                                    <div class="cart_page table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product_remove">Delete</th>
                                                    <th class="product_thumb">Image</th>
                                                    <th class="product_name">Product</th>
                                                    <th class="product-price">Price</th>
                                                    <th class="product_quantity">Quantity</th>
                                                    <th class="product_total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody> @php

                                         
                                        
                                        $total = 0;
                                        @endphp
                                        @foreach (Session::get('cart') as $key => $cartItem)
                                            @php
                                            $product = \App\Product::find($cartItem['id']);
                                            
                                          
                                            if($cartItem['quantity'] != null){
                                                if(count($cartItem['quantity'])>0){
                                                    $quantity = $cartItem['quantity'][0];
                                                }else{
                                                    $quantity  = $cartItem['quantity'];
                                                }
                                            }else{
                                                $quantity  = 1;
                                            }
                                       
                                            $total = $total + $cartItem['price'] * $quantity;
                                          
                                          

                                            $product_name_with_choice = $product->name;

                                      
                                            @endphp
                                                
                                           
                                                <tr>


                                                 <td class="product_remove"><a href="#" onclick="removeFromCart({{ $key }})"
                                                    ><i class="fa fa-trash-o"></i></a></td>
                                                    <td class="product_thumb"><a href="#"><img src="{{ asset($product->thumbnail_img) }}" alt=""></a></td>
                                                    <td class="product_name"><a href="#">{{
                                                        $product->name
                                                    }}</a></td>
                                                    <td class="product-price">{{ single_price($cartItem['price']) }}</td>

                                                    <td class="product_quantity">

                                                        <input type="text" name="quantity[{{ $key }}]" class="form-control input-number" placeholder="1" value="{{ $quantity }}" min="1" max="10" onchange="updateQuantity({{ $key }}, this)">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-number" type="button" data-type="plus" data-field="quantity[{{ $key }}]">
                                                                <i class="la la-plus"></i>
                                                            </button>
                                                        </span>

                                                    </td>


                                                    <td class="product_total">{{ single_price(($cartItem['price']+$cartItem['tax'])*$quantity) }}</td>


                                                </tr>
                                              
                                                 @endforeach
                                            </tbody>
                                        </table>   
                                    </div>  
                                    <div class="cart_submit">
                                    @if(Auth::check())
                                        <a href="{{ route('checkout.shipping_info') }}" class="btn btn-danger btn-base-1">{{__('Continue to Shipping')}}</a>
                                    @else
                                        <a href="#" class="btn btn-dark btn-base-1"  data-toggle="modal" data-target="#GuestCheckout">{{__('Continue to Shipping')}}</a>
                                    @endif
                                    </div>      
                                </div>
                             </div>
                         </div>
                   
                         <!--coupon code area start-->
                        <div class="coupon_area">
                            <div class="row">
                               
                                <div class="col-lg-12 col-md-12">
                                    <div class="coupon_code right">
                                        <h3>Cart Totals</h3>
                                        <div class="coupon_inner">
                                           <div class="cart_subtotal">
                                               <p>Subtotal</p>
                                               <p class="cart_amount">{{single_price($total)}} </p>
                                           </div>
                                           <div class="cart_subtotal ">
                                               <p>Shipping</p>
                                               <p class="cart_amount"><span>Flat Rate:</span>{{single_price(0)}} </p>
                                           </div>
                                           <a href="#">Calculate shipping</a>

                                           <div class="cart_subtotal">
                                               <p>Total</p>
                                               <p class="cart_amount">{{single_price($total)}}</p>
                                           </div>
                                           <div class="checkout_btn">
                                               <a href="{{route("checkout.shipping_info")}}">Proceed to Checkout</a>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--coupon code area end-->
                    </form>   
                    @else

                    <h3 class="text-center">Your shopping cart is empty ! </h3>

                    @endif
            </div>
           
        </div>
    </div>
    <!--shopping cart area end -->



     <!-- Modal -->
     <div class="modal fade" id="GuestCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <div class="input-group input-group--style-1">
                                    <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                                    <span class="input-group-addon">
                                        <i class="text-md la la-user"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <div class="input-group input-group--style-1">
                                    <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                    <span class="input-group-addon">
                                        <i class="text-md la la-lock"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{ route('password.request') }}" class="link link-xs link--style-3">{{__('Forgot password?')}}</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-success btn-base-1 px-4">{{__('Sign in')}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                     @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                        <div class="or or--1 mt-3 text-center">
                            <span>or</span>
                        </div>
                        <div class="p-3 pb-0">
                            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                </a>
                            @endif
                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 mb-3">
                                <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                            </a>
                            @endif
                        </div>
                    @endif
                    @if (\App\BusinessSetting::where('type', 'guest_checkout_active')->first()->value == 1)
                        <div class="or or--1 mt-0 text-center">
                            <span>or</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary btn-base-1">{{__('Guest Checkout')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    
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
                            <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand5.jpg')  }}" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand6.jpg') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="brand_list">
                        <div class="single_brand">
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="{{ asset('frontend_assets/assets/img/brand/brand8.jpg') }}" alt=""></a>
                        </div>
                    </div>
                     <div class="brand_list">
                        <div class="single_brand">
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
    <div class="newsletter_area newsletter_padding">
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
                            <h3>GET THE APP</h3>
                            <p>Mazlay App is now available on Google Play & App Store. Get it now.</p>
                            <div class="app_img">
                               <ul>
                                   <li><a href="#"><img src="assets/img/icon/icon-app.jpg" alt=""></a></li>
                                   <li><a href="#"><img src="assets/img/icon/icon1-app.jpg" alt=""></a></li>
                               </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--newsletter area end-->

    <script type="text/javascript">
    function removeFromCartView(e, key){
        e.preventDefault();
        removeFromCart(key);
        updateNavCart();
    }

    function updateQuantity(key, element){
        $.post('{{ route('cart.updateQuantity') }}', { _token:'{{ csrf_token() }}', key:key, quantity: element.value}, function(data){
            updateNavCart();
            $('#cart-summary').html(data);
        });
    }

    function showCheckoutModal(e){
    
        $('#GuestCheckout').modal();
    }
    </script>


@endsection


    