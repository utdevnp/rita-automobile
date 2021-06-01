<!doctype html>
<html class="no-js" lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Rita Automobiles </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend_assets/assets/img/favicon.ico') }}">
    
    <!-- CSS 
    ========================= -->

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/plugins.css') }}">
    
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    

</head>

<body>
   
    <!--header area start-->
    
    <!--offcanvas menu area start-->
    <div class="off_canvars_overlay">
                
    </div>
    <div class="offcanvas_menu">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="canvas_open">
                        <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                    </div>
                    <div class="offcanvas_menu_wrapper">
                        <div class="canvas_close">
                              <a href="javascript:void(0)"><i class="ion-android-close"></i></a>  
                        </div>
                       @php
                                $generalsetting = \App\GeneralSetting::first();
                            @endphp
                        <div class="call_support">
                            <p><i class="icon-phone-call" aria-hidden="true"></i> <span>Call us: <a href="tel:(+977) 9857025575">{{   $generalsetting->phone }}</a></span></p>

                        </div>
                        <div class="header_account">
                            <ul>
                                <li class="language"><a href="#"><img src="{{ asset('frontend_assets/assets/img/logo/language.png') }}" alt=""> english <i class="ion-chevron-down"></i></a>
                                    <ul class="dropdown_language">
                                        <li><a href="#">English</a></li>
                                        <li><a href="#">Germany</a></li>
                                        <li><a href="#">Japanese</a></li>
                                    </ul>
                                </li>
                                <li class="currency"><a href="#">USD <i class="ion-chevron-down"></i></a>
                                    <ul class="dropdown_currency">
                                        <li><a href="#">EUR – Euro</a></li>
                                        <li><a href="#">GBP – British Pound</a></li>
                                        <li><a href="#">INR – India Rupee</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="header_top_links">
                            <ul>
                               @if(Auth::check())
                                    <li><a href="#">Logout</a></li>
                                    <li><a href="#">Profiles</a></li>
                                @else
                                    <li><a href="#">Registers</a></li>
                                    <li><a href="#">login</a></li>
                                    <li><a href="#">Shopping Cart</a></li>
                                    <li><a href="#">Checkout</a></li>
                                @endif
                                
                               
                               
                            </ul>
                        </div> 
                        <div class="search_container">
                            <form action="{{ route('search.products') }}" method="GET">

                                <div class="search_box">
                                    <input placeholder="Search product..." type="text">
                                    <button type="submit">Search</button> 
                                </div>
                            </form>
                        </div>     @php
                        $pagelist = App\Page::where([['position', 'Header'], ['parentId', 0], ['status', 1]])->orderBY('weight', 'asc')->get();
                    @endphp

                        <div id="menu" class="text-left ">
                            <ul class="offcanvas_main_menu">
                       @foreach($pagelist as $key=>$page)
                                    @php
                                    $haveChild = false;
                                    @endphp

                                    @if(\App\Page::where([['parentId', $page->id], ['status', 1], ['position', 'Header']])->get()->count() > 0)
                                         @php $haveChild = true; @endphp
                                    @endif

 

                                <li class="menu-item-has-children active">
                                    <a href="@if(!$haveChild) {{ route('page-details',$page->slug)}}@endif">{{ $page->name }}@if($haveChild)
                                    @endif</a>
                                </li>


                          @if($haveChild)
                                <li class="menu-item-has-children">
                                    <a href="#">Company</a>
                                    <ul class="sub-menu">
                                         @foreach(\App\Page::where([['position', 'Header'], ['parentId', $page->id], ['status', 1]])->orderBY('weight', 'asc')->get() as $subkey => $subpage)
                                        <li><a href="about.html">{{ $subpage->name }}</a></li>

                                        @endforeach
                                    </ul>


                                </li>
                                @endif
                                  @endforeach

                                <li class="menu-item-has-children">
                                    <a href="{{ url('/contact') }}"> Contact Us</a> 
                                </li>
                            </ul>
                        </div>

                        <div class="offcanvas_footer">
                            <span><a href="#"><i class="fa fa-envelope-o"></i> 
                                {{ $generalsetting->email }}</a></span>
                            <ul>
                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="pinterest"><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--offcanvas menu area end-->
    
    <header>
        <div class="main_header">
            <!--header top start-->
            <div class="header_top">
               <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-5">
                            <!--<div class="header_account">
                                <ul>
                                    <li class="language"><a href="#"><img src="assets/img/logo/language.png" alt=""> english <i class="ion-chevron-down"></i></a>
                                        <ul class="dropdown_language">
                                            <li><a href="#">English</a></li>
                                            <li><a href="#">Germany</a></li>
                                            <li><a href="#">Japanese</a></li>
                                        </ul>
                                    </li>
                                    <li class="currency"><a href="#">USD <i class="ion-chevron-down"></i></a>
                                        <ul class="dropdown_currency">
                                            <li><a href="#">EUR – Euro</a></li>
                                            <li><a href="#">GBP – British Pound</a></li>
                                            <li><a href="#">INR – India Rupee</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>-->
                        </div>
                        <div class="col-lg-8 col-md-7">
                            <div class="header_top_links text-right">
                                <ul>
                                @if(Auth::check())
                                    <li><a href="{{ route('dashboard') }}">Welcome ! <b>{{Auth::user()->name}}</b> </a></li>
                                    <li><a href="{{ route('cart') }}">Shopping Cart</a></li>
                                    <li><a href="{{ route('checkout.shipping_info') }}">Checkout</a></li>
                                    <li><a href="{{ route('logout') }}"><i class="icon-power"></i> Logout</a></li>
                                @else
                                    <li><a href="{{ route('cart') }}">Shopping Cart</a></li>
                                    <li><a href="{{ route('user.registration') }}">Register</a></li>
                                    <li><a href="{{ route('user.login') }}">login</a></li>
                                @endif
                               

                                   
                                 
                                </ul>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
            <!--header top start-->

            <!--header middel start-->
            <div class="header_middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-4 col-sm-4 col-4">
                            <div class="logo">
                                   @php
                                $generalsetting = \App\GeneralSetting::first();
                            @endphp
                                <a href="{{ url('/') }}"><img src="
                                  {{ asset('frontend_assets/assets/img/logo/ritaauto-logo.png')  }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-6 col-sm-6 col-6">
                            <div class="header_right_box">
                                <div class="search_container">
               <form action="{{ route('search.products') }}" method="GET">
                     <div class="search_box">  
            <input placeholder="Search product..." type="text" name="search">
                                            <button type="submit">Search</button> 
                                        </div>
                                    </form>
                                </div>
                                <div class="header_configure_area">
                                    <!--<div class="header_wishlist">
                                        <a href="#"><i class="icon-heart"></i>
                                            <span class="wishlist_count">3</span>
                                        </a>
                                    </div>-->
                                    <div class="mini_cart_wrapper">
                                        <a href="javascript:void(0)">
                                            <i class="icon-shopping-bag2"></i>
                                            <span class="cart_price">Rs 0.00 <i class="ion-ios-arrow-down"></i></span>
                                            <span class="cart_count">
                                                  @if(Session::has('cart'))  {{ count(Session::get('cart'))}}  @else 0  @endif
                                            </span>
                                        </a>
                                        <!--mini cart-->
                                        <div id="cart_items"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--header middel end-->

            <!--header bottom satrt-->
            <div class="header_bottom sticky-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class=" col-lg-3">
                            <div class="categories_menu">
                                <div class="categories_title">
                                    <h2 class="categori_toggle">ALL CATEGORIES</h2>
                                </div>
                                <div class="categories_menu_toggle">
                                   
                                    <ul>
                                          @foreach (App\Category::all()->take(15) as $key => $category)
                                          @if($category->subcategories->count() > 1)
                                        <li class="menu_item_children"><a href="{{ route('products.category', $category->slug) }}">{{ $category->name }} <i class="fa fa-angle-right"></i></a>
                                            <ul class="categories_mega_menu">
                                             
                                             @foreach($category->subcategories as $key =>$subcategory)
                                                <li class="menu_item_children">
                                                    <a href="{{ route('products.subcategory', $subcategory->slug) }}">{{ $subcategory->name }}</a>
                                                    <ul class="categorie_sub_menu">
                                              @foreach($subcategory->subsubcategories as $key =>$subundercategory)
                                                       
        <li><a href="{{ route('products.subsubcategory',$subundercategory->slug) }}">{{ ($subundercategory->name) }}</a></li>                                      @endforeach

                                                    </ul>
                                                </li> 
                                               @endforeach

                                            </ul>
                                        </li>
                                        @else

                                          <li class="hidden"><a href="{{ route('products.category', $category->slug) }}"> {{ $category->name }} </a></li>
                                          @endif
                                               @endforeach
                                        <li><a href="#" id="more-btn"><i class="fa fa-plus" aria-hidden="true"></i> More Categories</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                                @php
                        $pagelist = App\Page::where([['position', 'Header'], ['parentId', 0], ['status', 1]])->orderBY('weight', 'asc')->get();
                    @endphp
                        <div class="col-lg-6">
                            <div class="main_menu menu_position text-left"> 
                               
                                <nav>  
                             
                                    <ul>
                             @foreach($pagelist as $key=>$page)
                                    @php
                                    $haveChild = false;
                                    @endphp

                                    @if(\App\Page::where([['parentId', $page->id], ['status', 1], ['position', 'Header']])->get()->count() > 0)
                                         @php $haveChild = true; @endphp
                                    @endif

 
                                       
                                    <li><a class="active"  href="@if(!$haveChild) {{ route('page-details',$page->slug)}}@endif">{{$page->name}}@if($haveChild)


                                    @endif</a>
                                        </li>
                                        

                                    

                                              @if($haveChild)
                                        <li><a href="#">Company <i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">

                                                    @foreach(\App\Page::where([['position', 'Header'], ['parentId', $page->id], ['status', 1]])->orderBY('weight', 'asc')->get() as $subkey => $subpage)
                                                    <li><a href="{{ route('page-details', $subpage->slug) }}">{{$subpage->name}}</a></li>
                                                   @endforeach
                                            </ul>
                                        </li> 
                                           @endif
                                      @endforeach
                                <li><a href="{{ url('/contact') }}">Contact us</a></li>
                                    </ul>  


                                </nav> 


                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="call_support text-right">
                                <p><i class="icon-phone-call" aria-hidden="true"></i> <span>Call us: <a href="tel:(+977) 9857025575">(+977) 9857025575</a></span></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--header bottom end-->
        </div> 
    </header>
    <!--header area end-->
    