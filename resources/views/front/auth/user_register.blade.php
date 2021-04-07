@extends('front.layouts.master')
@section('content')
 <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>My account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->
    
    <!-- customer login start -->
    <div class="login_page_bg">
        <div class="container">
            <div class="customer_login">
                <div class="row">
                   <!--login area start-->
                    <div class="col-lg-3 col-md-3">
                       <!--  <div class="account_form login">
                            <h2>login</h2>
                            <form action="#">
                                <p>   
                                    <label>Username or email <span>*</span></label>
                                    <input type="text">
                                 </p>
                                 <p>   
                                    <label>Passwords <span>*</span></label>
                                    <input type="password">
                                 </p>   
                                <div class="login_submit">
                                   <a href="#">Lost your password?</a>
                                    <label for="remember">
                                        <input id="remember" type="checkbox">
                                        Remember me
                                    </label>
                                    <button type="submit">login</button>

                                </div>

                            </form>
                         </div>  -->   
                    </div>
                    <!--login area start-->

                    <!--register area start-->
                    <div class="col-lg-6 col-md-6">
                        <div class="account_form register">
                             <h2  style="text-align:center">Create an account</h2>
                            <form action="#">
                                <p>   
                                    <label>Email address  <span>*</span></label>
                                    <input type="text">
                                 </p>
                                 <p>   
                                    <label>Passwords <span>*</span></label>
                                    <input type="password">
                                 </p>
                                <div class="login_submit">
                                    <button type="submit">Register</button>
                                </div>
                                   <a href="{{ route('user.login') }}">  <p>if you have already account? please login  Now</p></a>
                            </form>

                        </div>    
                    </div>
                    <!--register area end-->
                </div>   
            </div>
        </div>
    </div>
    
    <!-- customer login end -->

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