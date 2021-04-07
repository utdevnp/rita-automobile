 <!--header area start-->
    <header class="header_area">
        <!--header center area start sticky-header-->
        <div class="header_middle ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo">
                            @php
                                $generalsetting = \App\GeneralSetting::first();
                            @endphp
                          
                            <a href="{{ route('home') }}">
                                  @if($generalsetting->logo != null)
                                   <img src="{{ asset($generalsetting->logo) }}" alt="{{ env('APP_NAME') }}">
                                  @else
                                   <img src="{{ asset('frontend/images/logo/logo.png') }}" alt="{{ env('APP_NAME') }}">
                                  @endif
                             </a>

                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="header_middle_inner">
                            <div class="search-container">
                               <form action="{{ route('search') }}" method="GET">
                                   <div class="hover_category">
                                        <select class="select_option" name="category" id="category">
                                            <option value="">{{__('All Categories')}}</option>
                                            @foreach (\App\Category::all() as $key => $category)
                                            <option value="{{ $category->slug }}"
                                                @isset($category_id)
                                                    @if ($category_id == $category->id) 
                                                        selected
                                                    @endif
                                                @endisset
                                                >{{ __($category->name) }}</option>
                                            @endforeach
                                        </select>                        
                                   </div>
                                    <div class="search_box">
                                        <input id="search" name="q" placeholder="Search product..." type="text">
                                        <button type="submit"><i class="zmdi zmdi-search"></i></button> 
                                    </div>
                                </form>
                            </div>
                            <div class="mini_cart_wrapper" id="cart_items">
                                <a href="javascript:void(0)"><i class="zmdi zmdi-shopping-basket"></i> <span>
                              @if(Session::has('cart'))  {{ count(Session::get('cart'))}}  @else 0  @endif</span> </a>
                                <!--mini cart-->
                                 <div class="mini_cart" style="z-index: 1000;">

                                    @php
                                        $total = 0;
                                    @endphp 

                                     @if(Session::has('cart'))
                                        @if(count($cart = Session::get('cart')) > 0)

                                    @foreach($cart as $key => $cartItem)
                                        @php
                                            $product = \App\Product::find($cartItem['id']);
                                            $total = $total + $cartItem['price']*$cartItem['quantity'];
                                        @endphp   

                                        <div class="cart_item">
                                           <div class="cart_img">
                                               <a href="{{ route('product', $product->slug) }}"><img src="{{ asset($product->thumbnail_img) }}" alt=""></a>
                                           </div>
                                            <div class="cart_info">
                                                <a href="{{ route('product', $product->slug) }}">{{ __($product->name) }}</a>
                                                <span class="quantity">Qty: x{{ $cartItem['quantity'] }}</span>
                                                <span class="price_cart">{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span>

                                            </div>
                                            <div class="cart_remove">
                                                <a  onclick="removeFromCart({{ $key }})"><i class="ion-android-close"></i></a>
                                            </div>
                                        </div>

                                    @endforeach

                                    <div class="mini_cart_table">
                                        <div class="cart_total">
                                            <span>Subtotal:</span>
                                            <span class="price">{{ single_price($total) }}</span>
                                        </div>
                                    </div>

                                    <div class="mini_cart_footer">
                                       <div class="cart_button">
                                            <a href="{{ route('cart') }}">View cart</a>
                                             @if (Auth::check())
                                            <a href="{{ route('checkout.shipping_info') }}">Checkout</a>
                                            @endif
                                        </div>
                                    </div>

                                     @else
                                        <div class="dc-header">
                                            <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                                        </div>
                                    @endif
                                @else
                                    <div class="dc-header">
                                        <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                                    </div>
                                @endif

                                </div>
                                <!--mini cart end-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="top_right text-right">
                            <ul>
                             
                                <li class="top_links"><a href="#" style="padding: 5px 15px;border: solid 1px #e5e5e5;border-radius: 10px"><i class="zmdi zmdi-account" style="font-size: 22px"></i>  </a>
                                    <ul class="dropdown_links">
                                        @auth
                                        <li><a href="{{ route('dashboard') }}">{{__('My Panel')}} </a></li>
                                        <li><a href="{{ route('logout') }}">{{__('Logout')}}</a></li>
                                        @else
                                           <li><a href="{{ route('user.login') }}">{{__('Login')}}</a></li>
                                           <li><a href="{{ route('user.registration') }}">{{__('Registration')}}</a></li>

                                        @endif
                                        
                                    </ul>
                                </li>

                                 @php
                                if(Session::has('currency_code')){
                                    $currency_code = Session::get('currency_code');
                                }
                                else{
                                    $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code; 
                                }
                            @endphp

                                <li class="currency" id="currency-change">
                                    <a href="#" >
                                         {{ (\App\Currency::where('code', $currency_code)->first()->symbol) }} <i class="zmdi zmdi-caret-down"></i>
                                    </a>
                                    <ul class="dropdown_currency">
                                     @foreach (\App\Currency::where('status', 1)->get() as $key => $currency)  
                                        <li class="dropdown-item"><a href="" data-currency="{{ $currency->code }}" @if($currency_code == $currency->code) class="text-danger" @endif>{{ $currency->name }} ({{ $currency->symbol }})</a></li>
                                     @endforeach   
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--header center area end-->

       

        <!--header middel start-->
        <div class="header_bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="categories_menu categori_two">
                            <div class="categories_title ">
                                <h2 class="categori_toggle">{{__('CATEGORIES')}}</h2>
                            </div>
                            <div class="categories_menu_toggle" @if(empty($check_home)) style="display: none;" @endif>   
                                <ul>

                                    @foreach (\App\Category::all()->take(11) as $key => $category)
                                    @php
                                        $brands = array();
                                    @endphp
                                    
                                    <li @if(count($category->subcategories)>0) class="menu_item_children" @endif><a href="{{ route('products.category', $category->slug) }}"><span> <img class="cat-image lazyload" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($category->icon) }}" width="30" alt="{{ __($category->name) }}"> </span>   {{ __($category->name) }} @if(count($category->subcategories)>0) <i class="fa fa-angle-right"></i> @endif</a> 
                                        @if(count($category->subcategories)>0)
                                        <ul class="categories_mega_menu column_3">
                                             
                                             @foreach($category->subcategories as $key =>$subcategory)
                                            <li class="menu_item_children"><a href="{{ route('products.subcategory', $subcategory->slug) }}">{{$subcategory->name}}</a>
                                                @if(count($subcategory->subsubcategories)>0)
                                            
                                                <div class="categorie_sub_menu">
                                                    <ul>
                                                         @foreach($subcategory->subsubcategories as $key => $subsubcategory)
                                                        <li><a href="{{ route('products.subsubcategory', $subsubcategory->slug) }}">{{ __($subsubcategory->name) }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                
                                                @endif
                                            </li>
                                            @endforeach    
                                        </ul>
                                           @endif
                                    </li>

                                    @endforeach
                                   
                                  <!--   <li><a href="#" id="more-btn"><i class="fa fa-plus" aria-hidden="true"></i> More Categories</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>

                    @php
                        $pagelist = \App\Page::where([['position', 'Header'], ['parentId', 0], ['status', 1]])->orderBY('weight', 'asc')->get();
                    @endphp

                    <div class="col-lg-9">
                        <div class="main_menu menu_two header_position">
                            <nav>
                                <ul>
                                    @foreach($pagelist as $key=>$page)
                                    @php
                                    $haveChild = false;
                                    @endphp

                                    @if(\App\Page::where([['parentId', $page->id], ['status', 1], ['position', 'Header']])->get()->count() > 0)
                                         @php $haveChild = true; @endphp
                                    @endif
  
                                    <li>
                                        <a href="@if(!$haveChild) {{ route('page-details',$page->slug)}}@endif">{{$page->name}} @if($haveChild)<i class="zmdi zmdi-caret-down"></i>
                                        @endif</a>

                                         @if($haveChild)
                                            <div class="mega_menu">
                                                <ul class="mega_menu_inner">
                                                    <li><a href="#">Other Pages</a>

                                                        <ul>
                                                            @foreach(\App\Page::where([['position', 'Header'], ['parentId', $page->id], ['status', 1]])->orderBY('weight', 'asc')->get() as $subkey => $subpage)
                                                            <li><a href="{{ route('page-details', $subpage->slug) }}">{{$subpage->name}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>

                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                    
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--header middel end-->
     
    </header>
    <!--header area end-->
    
    <!--Offcanvas menu area start-->
    
    <div class="off_canvars_overlay">
                
    </div>
    <div class="Offcanvas_menu">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="canvas_open">
                        <span>MENU</span>
                        <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                    </div>
                    <div class="Offcanvas_menu_wrapper">
                        <div class="canvas_close">
                              <a href="javascript:void(0)"><i class="ion-android-close"></i></a>  
                        </div>
                        <div class="welcome_text">
                           <p>Welcome to <span>Our Store</span> </p>
                       </div>

                        @php
                                if(Session::has('currency_code')){
                                    $currency_code = Session::get('currency_code');
                                }
                                else{
                                    $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code; 
                                }
                            @endphp
                       
                        <div class="top_right">
                            <ul>
                                <li class="currency"><a href="#">  {{ (\App\Currency::where('code', $currency_code)->first()->symbol) }}<i class="zmdi zmdi-caret-down"></i></a>
                                    <ul class="dropdown_currency">
                                         @foreach (\App\Currency::where('status', 1)->get() as $key => $currency)  
                                        <li><a href="" data-currency="{{ $currency->code }}" @if($currency_code == $currency->code) class="text-danger" @endif>{{ $currency->name }} ({{ $currency->symbol }})</a></li>
                                        @endforeach
                                       
                                    </ul>
                                </li>
                               <li class="language"><a href="#"><i class="zmdi zmdi-dribbble"></i> English1 <i class="zmdi zmdi-caret-down"></i></a>
                                    <ul class="dropdown_language">
                                        <li><a href="#">English</a></li>
                                        <li><a href="#">Germany</a></li>
                                    </ul>
                                </li>
                                <li class="top_links"><a href="#"><i class="zmdi zmdi-account"></i> My account <i class="zmdi zmdi-caret-down"></i></a>
                                    <ul class="dropdown_links">
                                        @auth
                                        <li><a href="{{ route('dashboard') }}">{{__('My Panel')}} </a></li>
                                        <li><a href="{{ route('logout') }}">{{__('Logout')}}</a></li>
                                        @else
                                           <li><a href="{{ route('user.login') }}">{{__('Login')}}</a></li>
                                           <li><a href="{{ route('user.registration') }}">{{__('Registration')}}</a></li>

                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div> 
                        
                        <div class="search-container">
                           <form action="{{ route('search') }}" method="GET">  
                               <div class="hover_category">
                                    <select class="select_option" name="category" id="category">
                                          <option value="">{{__('All Categories')}}</option>
                                       @foreach (\App\Category::all() as $key => $category)
                                            <option value="{{ $category->slug }}"
                                                @isset($category_id)
                                                    @if ($category_id == $category->id) 
                                                        selected
                                                    @endif
                                                @endisset
                                                >{{ __($category->name) }}</option>
                                            @endforeach
                                    </select>                        
                               </div>
                                <div class="search_box">
                                    <input placeholder="Search product..." type="text" name="q">
                                    <button type="submit"><i class="zmdi zmdi-search"></i></button> 
                                </div>
                            </form>
                        </div> 
                        <div class="mini_cart_wrapper">
                            <a href="javascript:void(0)"><i class="zmdi zmdi-shopping-basket"></i> <span> @if(Session::has('cart'))  {{ count(Session::get('cart'))}}  @else 0  @endif</span> </a>
                            <!--mini cart-->
                             <div class="mini_cart">

                                 @php
                                        $total = 0;
                                    @endphp 

                                     @if(Session::has('cart'))
                                        @if(count($cart = Session::get('cart')) > 0)

                                    @foreach($cart as $key => $cartItem)
                                         @php
                                            $product = \App\Product::find($cartItem['id']);
                                            $total = $total + $cartItem['price']*$cartItem['quantity'];
                                        @endphp  

                                <div class="cart_item">
                                   <div class="cart_img">
                                       <a href="{{ route('product', $product->slug) }}"><img src="{{ asset($product->thumbnail_img) }}" alt=""></a>
                                   </div>
                                    <div class="cart_info">
                                        <a href="{{ route('product', $product->slug) }}">{{ __($product->name) }}</a>
                                        <span class="quantity">x{{ $cartItem['quantity'] }}</span>
                                        <span class="price_cart">{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span>

                                    </div>
                                    <div class="cart_remove">
                                        <a onclick="removeFromCart({{ $key }})"><i class="ion-android-close"></i></a>
                                    </div>
                                </div>

                                @endforeach
                             
                                <div class="mini_cart_table">
                                    <div class="cart_total">
                                        <span>Subtotal:</span>
                                        <span class="price">{{ single_price($total) }}</span>
                                    </div>
                                </div>

                                <div class="mini_cart_footer">
                                   <div class="cart_button">
                                        <a href="{{ route('cart') }}">{{__('View cart')}}</a>
                                        @if (Auth::check())
                                           <a href="`{{ route('checkout.shipping_info') }}">{{__('Checkout')}}</a>
                                        @endif
                                    </div>
                                </div>

                                @else
                                    <div class="dc-header">
                                        <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                                    </div>
                                @endif
                            @else
                                <div class="dc-header">
                                    <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                                </div>
                            @endif

                            </div>
                            <!--mini cart end-->
                        </div>
                        <div id="menu" class="text-left">
                             <ul class="offcanvas_main_menu">

                                @foreach($pagelist as $key=>$page)
                                @php
                                $haveChild = false;
                                @endphp

                                @if(\App\Page::where([['parentId', $page->id], ['status', 1], ['position', 'Header']])->get()->count() > 0)
                                     @php $haveChild = true; @endphp
                                @endif

                                <li class="menu-item-has-children active">  
                                    <a href="@if(!$haveChild) {{ route('page-details',$page->slug)}}@endif">{{$page->name}}</a>
                                          
                                </li>

                                @endforeach

                            </ul>
                        </div>

                                 @php
                                    $generalsetting = \App\GeneralSetting::first();
                                 @endphp

                        <div class="Offcanvas_footer">
                            <span><a href="#"><i class="fa fa-envelope-o"></i>{{ $generalsetting->email }}</a></span>
                            <ul>
                                

                                @if ($generalsetting->facebook != null)
                                   <li class="facebook"><a href="{{ $generalsetting->facebook }}"><i class="fa fa-facebook"></i></a></li>
                                @endif

                                @if ($generalsetting->twitter != null)
                                    <li class="twitter"><a href="{{ $generalsetting->twitter }}"><i class="fa fa-twitter"></i></a></li>
                                @endif

                                @if ($generalsetting->pinterest != null)
                                   <li class="pinterest"><a href="{{ $generalsetting->pinterest }}"><i class="fa fa-pinterest-p"></i></a></li>
                                @endif

                                 @if ($generalsetting->youtube != null)
                                     <li class="google-plus"><a href="{{ $generalsetting->youtube }}"><i class="fa fa-youtube"></i></a></li>
                                @endif

                                @if ($generalsetting->google_plus != null)
                                     <li class="google-plus"><a href="{{ $generalsetting->google_plus }}"><i class="fa fa-google-plus"></i></a></li>
                                @endif
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Offcanvas menu area end-->