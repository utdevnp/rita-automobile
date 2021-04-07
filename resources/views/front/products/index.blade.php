
@extends('front.layouts.master')
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
                        @if(isset($category_id))
                            <li class="active"><a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}" class="text-danger">{{ \App\Category::find($category_id)->name }}</a></li>
                        @endif
                        @if(isset($subcategory_id))
                            <li ><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}">{{ \App\SubCategory::find($subcategory_id)->category->name }}</a></li>

                            <li class="active"><a href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}" class="text-danger">{{ \App\SubCategory::find($subcategory_id)->name }}</a></li>


                        @endif
                        @if(isset($subsubcategory_id))
                            <li ><a href="{{ route('products.category', \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name }}</a></li>
                            <li ><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">{{ \App\SubsubCategory::find($subsubcategory_id)->subcategory->name }}</a></li>
                            <li class="active"><a href="{{ route('products.subsubcategory', \App\SubSubCategory::find($subsubcategory_id)->slug) }}" class="text-danger active">{{ \App\SubSubCategory::find($subsubcategory_id)->name }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--shop  area start-->
<div class="shop_area shop_reverse">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <!--sidebar widget start-->
                <aside class="sidebar_widget">
                    <div class="widget_list widget_categories">
                        <h3>Categories</h3>
                        <ul>

                           @if(!isset($category_id) && !isset($category_id) && !isset($subcategory_id) && !isset($subsubcategory_id))
                             
                                            @foreach(\App\Category::all() as $category)
                                                <li class=""><a href="{{ route('products.category', $category->slug) }}">{{ __($category->name) }}</a></li>
                                            @endforeach
                                        @endif
                                        @if(isset($category_id))
                                            <li class="active"><a href="{{ route('products') }}"><i class="fa fa-angle-left"></i>&nbsp;<strong>{{__('All Categories')}}</strong></a></li>
                                            <li class="active"><a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}"> <i class="fa fa-angle-left"></i>&nbsp;<strong>{{ __(\App\Category::find($category_id)->name) }}</strong></a></li>

                                            @foreach (\App\Category::find($category_id)->subcategories as $key2 => $subcategory)
                                                <li class="child"><a href="{{ route('products.subcategory', $subcategory->slug) }}">{{ __($subcategory->name) }}</a></li>
                                            @endforeach
                                        @endif
                                        @if(isset($subcategory_id))
                                            <li class="active"><a href="{{ route('products') }}"><i class="fa fa-angle-left">&nbsp;</i><strong>{{__('All Categories')}}</strong></a></li>
                                            <li class="active"><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}"><i class="fa fa-angle-left">&nbsp;</i><strong>{{ __(\App\SubCategory::find($subcategory_id)->category->name) }}</strong></a></li>
                                            <li class="active"><a href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}"><i class="fa fa-angle-left">&nbsp;</i><strong>{{ __(\App\SubCategory::find($subcategory_id)->name) }}</strong></a></li>
                                            @foreach (\App\SubCategory::find($subcategory_id)->subsubcategories as $key3 => $subsubcategory)
                                                <li class="child"><a href="{{ route('products.subsubcategory', $subsubcategory->slug) }}">{{ __($subsubcategory->name) }}</a></li>
                                            @endforeach
                                        @endif
                                        @if(isset($subsubcategory_id))
                                            <li class="active"><a href="{{ route('products') }}"><i class="fa fa-angle-left">&nbsp;</i><strong>{{__('All Categories')}}</strong></a></li>
                                            <li class="active"><a href="{{ route('products.category', \App\SubsubCategory::find($subsubcategory_id)->subcategory->category->slug) }}"><i class="fa fa-angle-left">&nbsp;</i><strong>{{ __(\App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name) }}</strong></a></li>
                                            <li class="active"><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}"><i class="fa fa-angle-left">&nbsp;</i><strong>{{ __(\App\SubsubCategory::find($subsubcategory_id)->subcategory->name) }}</strong></a></li>
                                            <li class="current"><a href="{{ route('products.subsubcategory', \App\SubsubCategory::find($subsubcategory_id)->slug) }}">{{ __(\App\SubsubCategory::find($subsubcategory_id)->name) }}</a></li>
                                        @endif
 


                           <!--  <li class="widget_sub_categories"><a href="javascript:void(0)">Wheels & Tyres</a>
                                <ul class="widget_dropdown_categories">
                                    <li><a href="#">Wheels</a></li>
                                    <li><a href="#">Tyres</a></li>
                                </ul>
                            </li>
                 -->

                        </ul>
                    </div>
                    <div class="widget_list widget_filter">
                        <h3>Price</h3>
                        <form action="">
                            <div id="slider-range" data-range-value-min="{{ filter_products(App\Product::query())->get()->min('unit_price') }}" data-range-value-max="{{ filter_products(App\Product::query())->get()->max('unit_price') }}"></div>
                            <button type="submit">Filter</button>
                            <input type="text" name="text" id="amount" />

                        </form>
                    </div>
                    <div class="widget_list widget_categories">
                        <h3>Manufacturer</h3>
                        <ul>
                            <li>
                                <input id="check1" type="checkbox">
                                <label for="check1">Toyota (8)</label>
                                <span class="checkmark"></span>
                            </li>
                            <li>
                                <input id="check2" type="checkbox">
                                <label for="check2">Diesel (8)</label>
                                <span class="checkmark"></span>
                            </li>
                            <li>
                                <input id="check3" type="checkbox">
                                <label for="check3">Honda (8)</label>
                                <span class="checkmark"></span>
                            </li>
                            <li>
                                <input id="check4" type="checkbox">
                                <label for="check4">Tata (8)</label>
                                <span class="checkmark"></span>
                            </li>
                        </ul>
                    </div>
                    <div class="widget_list tags_widget">
                        <h3>Product tags</h3>
                        <div class="tag_cloud">
                            <a href="#">brakes</a>
                            <a href="#">tyres</a>
                            <a href="#">lights</a>
                            <a href="#">glass</a>
                            <a href="#">rim</a>
                        </div>
                    </div>
                </aside>
                <!--sidebar widget end-->
            </div>
            <div class="col-lg-9 col-md-12">

                <!--shop banner area start-->
                <div class="shop_banner_area mb-30">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop_banner_thumb">
                                <img src="{{ asset('frontend_assets/assets/img/bg/banner23.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <!--shop banner area end-->
                <!--shop toolbar start-->
                <div class="shop_toolbar_wrapper">
                    <div class="shop_toolbar_btn">
                        <button data-role="grid_4" type="button"  class="active btn-grid-4" data-toggle="tooltip" title="4"></button>
                        <button data-role="grid_3" type="button" class=" btn-grid-3" data-toggle="tooltip" title="3"></button>
                        <button data-role="grid_list" type="button"  class="btn-list" data-toggle="tooltip" title="List"></button>
                    </div>
                     <button data-role="grid_list" type="button"  class="btn-list" title="List" id="short"></button>
                    <div class=" niceselect_option">
                        <form class="select_option" action="{{ url('/sort') }}">
                         
                            <select name="orderby" id="">

                                <option selected value="1">Sort by average rating</option>
                                <option  value="2">Sort by popularity</option>
                                <option value="3">Sort by newness</option>
                                <option value="4">Sort by price: low to high</option>
                                <option value="5">Sort by price: high to low</option>
                                <option value="6">Product Name: Z</option>
                            </select>
                             <button type="submit" style="float:right">Filter</button>
                        </form>
                    </div>
                    <div class="page_amount">
                        <p>Showing 1–9 of 21 results</p>
                    </div>
                </div>

                <!--shop toolbar end-->
                <div class="row shop_wrapper">
                    @if($products->count() > 0)
             @foreach($products as $product)

                    <div class="col-lg-3 col-md-4 col-12" id="box">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                           <a class="primary_img" href="product-details.html"><img src="{{ asset('frontend_assets/assets/img/product/product1.jpg') }}" alt=""></a>
                                    <a class="secondary_img" href=""><img src="{{ asset('frontend_assets/assets/img/product/product2.jpg') }}" alt=""></a>
                                </div>
                                <div class="product_content grid_content">
                                    <div class="product_content_inner">
                                        
                                        <p class="manufacture_product"><a href="{{ route('product',$product->slug) }}"> {{ $product->name }}</a></p>

                                        <h4 class="product_name"><a href="{{ route('product',$product->slug) }}">Nunc Neque Eros</a></h4>
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
                                               <del class="old-product-price strong-400">
                                                   {{ $product->unit_price }}
                                               </del>
 @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                            <span class="current_price">${{ home_base_price($product->purchase_price) }}</span>
                                            @endif

                                            <span class="current_price">${{ $product->purchase_price }}</span>

                                        </div>

                                    </div>

                                    <form  id="option-choice-form"> 
                                          @csrf

                                    <input type="hidden" name="id" value="{{ $product->id }}">
                           
                                 </form>

                                    <div class="action_links">
                                        <ul>
            <li class="add_to_cart"><a onclick="classToCart({{$product->id}})" title="Add to cart">Add to cart</a></li>

                                        </ul>
                                    </div>


                                </div>
                                <div class="product_content list_content">
                                    <div class="left_caption">
                                        <p class="manufacture_product"><a href="#">Parts</a></p>
                                        <h4 class="product_name"><a href="product-details.html">Nunc Neque Eros</a></h4>
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
                                            <span class="current_price">${{ home_base_price($product->purchase_price) }}</span>
                                            @endif
                                            <span class="current_price">{{ $product->purchase_price }}</span>

                                        </div>
                                        <div class="product_desc">
                                            <p>{! __($product->description) !}</p>
                                        </div>
                                    </div>
                                    <div class="right_caption">
                                        <p class="text_available">Availability: <span>In Stock</span></p>
                                        <div class="action_links">
                                            <ul>
                                                
                                                
                     <li class="add_to_cart"><a href="#" title="Add to cart" onclick="classToCart(this)">Add to cart</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </figure>
                        </article>
                    </div>
          

                  @endforeach
                
      @else
      
                       @if(isset($category_id))
                    @php
                       $category_slug = App\Category::where('id', $category_id)->first();
                        $slug=$category_slug->slug;
                    @endphp
     <div class="alert alert-secondary" role="alert">
  Oops!! sorry your  {{ $slug }} product doesnot found
</div>
                        @endif




                        @if(isset($subcategory_id))
                    @php
                       $subcategory_slug = App\SubCategory::where('id', $subcategory_id)->first();
                        $subcategoryslug=$subcategory_slug->slug;
                    @endphp
                                      <div class="alert alert-secondary" role="alert">

  Oops!! sorry your  {{ $subcategoryslug }} product doesnot found
</div>
                        @endif

  @if(isset($subsubcategory_id))
                    @php
                       $subsubcategory_slug = App\SubSubCategory::where('id', $subsubcategory_id)->first();
                        $sub_categoryslug=$subsubcategory_slug->slug;
                    @endphp
                                      <div class="alert alert-secondary" role="alert">

  Oops!! sorry your  {{ $sub_categoryslug }} product doesnot found
</div>
                        @endif




                        @endif
                       
         
        


                <div class="shop_toolbar t_bottom">
                    <div class="pagination">
                        <ul>
                            
                        </ul>
                    </div>
                </div>
                 
                <!--shop toolbar end-->
                <!--shop wrapper end-->
            </div>








        </div>
    </div>
</div>

<!--shop  area end-->


@endsection