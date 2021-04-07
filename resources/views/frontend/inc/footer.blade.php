  
    <!--brand newsletter area start-->
    <div class="brand_newsletter_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand_container owl-carousel">
                        @php 
                           $brands = \App\Brand::orderBy('id','desc')->take(10)->get();
                        @endphp

                        @foreach($brands as $brand)
                        <div class="single_brand">
                            <a href="{{ route('products.brand', $brand->slug) }}"><img src="{{asset($brand->logo)}}" alt="{{$brand->name}}" style="height: 100px;"></a>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="newsletter_inner">
                        <div class="newsletter_content">
                            <h2>SUBSCRIBE TO OUR NEWSLETTER</h2>
                        </div>
                        <div class="newsletter_form">
                            <form method="POST" action="{{ route('subscribers.store') }}">
                                <input name="email" placeholder="Email..." type="text" required>
                                <button type="submit"><i class="zmdi zmdi-mail-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--brand area end-->

     @php
        $generalsetting = \App\GeneralSetting::first();
     @endphp

    
    <!--footer area start-->
    <footer class="footer_widgets" style="background-color: #e6edfd; ">
        <div class="container">  
            <div class="footer_top">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="widgets_container contact_us">
                            <a href="{{ route('home') }}">
                                 @if($generalsetting->logo != null)
                                <img loading="lazy"  src="{{ asset($generalsetting->logo) }}" alt="{{ env('APP_NAME') }}" style="height: 44px;">
                                @else
                                    <img loading="lazy"  src="{{ asset('frontend/images/logo/logo.png') }}" alt="{{ env('APP_NAME') }}" style="height: 44px;">
                                @endif
                            </a>
                            <div class="footer_contact">
                                <ul>
                                    <li><i class="zmdi zmdi-home"></i><span>Addresss:</span>{{ $generalsetting->address }}</li>
                                    <li><i class="zmdi zmdi-phone-setting"></i><span>Phone:</span><a href="tel:{{ $generalsetting->phone }}">{{ $generalsetting->phone }}</a> </li>
                                    <li><i class="zmdi zmdi-email"></i><span>Email:</span>  {{ $generalsetting->email  }}</li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-7">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="widgets_container widget_menu">
                                    <h3>{{__('Useful Link')}}</h3>
                                    <div class="footer_menu">
                                        <ul>
                                            @foreach (\App\Link::all() as $key => $link)
                                            <li><a href="{{ $link->url }}">{{ $link->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="widgets_container widget_menu">
                                    <h3> {{__('My Account')}}</h3>
                                    <div class="footer_menu">
                                        <ul>

                                        @if (Auth::check())
                                            <li>
                                                <a href="{{ route('logout') }}" title="Logout">
                                                    {{__('Logout')}}
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('user.login') }}" title="Login">
                                                    {{__('Login')}}
                                                </a>
                                            </li>
                                        @endif

                                         <li>
                                            <a href="{{ route('purchase_history.index') }}" title="Order History">
                                                {{__('Order History')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('wishlists.index') }}" title="My Wishlist">
                                                {{__('My Wishlist')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('orders.track') }}" title="Track Order">
                                                {{__('Track Order')}}
                                            </a>
                                        </li>

                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="widgets_container">
                         <h3>{{__('Social Media')}}</h3>
                             <div class="social_icone">

                                <ul>
                                    @if ($generalsetting->youtube != null)
                                        <li class="youtube"><a href="{{ $generalsetting->youtube }}" title="Youtube"><i class="fa fa-youtube"></i></a>
                                            <div class="social_title">
                                                <p>Subscribe</p>
                                                <h3>Youtube</h3>
                                            </div>    
                                        </li>
                                    @endif

                                    @if ($generalsetting->twitter != null)
                                    <li class="twitter"><a href="{{ $generalsetting->twitter }}" title="twitter"><i class="fa fa-twitter"></i></a>
                                        <div class="social_title">
                                            <p>Follow Us</p>
                                            <h3>Twitter</h3>
                                        </div> 
                                    </li>
                                    @endif

                                    @if ($generalsetting->facebook != null)
                                    <li class="facebook"><a href="{{ $generalsetting->facebook }}" title="facebook"><i class="fa fa-facebook"></i></a>
                                        <div class="social_title">
                                            <p>Find Us</p>
                                            <h3>Facebook</h3>
                                        </div>
                                    </li>
                                    @endif

                                    @if ($generalsetting->google_plus != null)
                                    <li class="google_plus"><a href="{{ $generalsetting->google_plus }}" title="google"><i class="fa fa-google-plus"></i></a>
                                        <div class="social_title">
                                            <p>Find Us</p>
                                            <h3>Google+</h3>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

         <div class="footer_bottom">      
            <div class="container">
               <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="copyright_area">
                            <p>Copyright &copy; 2020 <a href="#"> Ecommerce </a>  All Right Reserved.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="footer_payment text-right">
                            <p><img src="{{ asset('/frontend/img/icon/payment.png') }}" alt=""></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>     
    </footer>
    <!--footer area end-->
