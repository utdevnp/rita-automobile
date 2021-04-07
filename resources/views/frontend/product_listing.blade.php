@extends('frontend.layouts.app')


@if(isset($subsubcategory_id))   
    @php
        $meta_title = \App\SubSubCategory::find($subsubcategory_id)->meta_title;
        $meta_description = \App\SubSubCategory::find($subsubcategory_id)->meta_description;
    @endphp
@elseif (isset($subcategory_id))
    @php
        $meta_title = \App\SubCategory::find($subcategory_id)->meta_title;
        $meta_description = \App\SubCategory::find($subcategory_id)->meta_description;
    @endphp
@elseif (isset($category_id))
    @php
        $meta_title = \App\Category::find($category_id)->meta_title;
        $meta_description = \App\Category::find($category_id)->meta_description;
    @endphp
@elseif (isset($brand_id))
    @php
        $meta_title = \App\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Brand::find($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title = env('APP_NAME');
        $meta_description = \App\SeoSetting::first()->description;   
    @endphp
@endif    

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
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
<div class="shop_area  mt-50 mb-50">   
       <form class="" id="search-form" action="{{ route('search') }}" method="GET">
    <div class="container">
        <div class="row">

            <div class="side-filter col-lg-3 col-md-12">
                <!--sidebar widget start-->
                <div class="filter-overlay filter-close"></div>

                <div class="filter-wrapper c-scrollbar">
                   <div class="filter-title d-flex d-xl-none justify-content-between pb-3 align-items-center">
                        <h3 class="h6">Filters</h3>
                        <button type="button" class="close filter-close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <aside class="sidebar_widget">

                    <div class="widget_list widget_categories">
                        <h2>categories</h2>
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

                        </ul> 
                    </div>

                    <div class="widget_list recent_product">

                        <h2>Price range</h2>
                        <div class="recent_product_container">

                             <div class="range-slider-wrapper mt-3">
                                    <!-- Range slider container -->
                                    <div id="input-slider-range" data-range-value-min="{{ filter_products(\App\Product::query())->get()->min('unit_price') }}" data-range-value-max="{{ filter_products(\App\Product::query())->get()->max('unit_price') }}"></div>

                                    <!-- Range slider values -->
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="range-slider-value value-low"
                                                @if (isset($min_price))
                                                    data-range-value-low="{{ $min_price }}"
                                                @elseif($products->min('unit_price') > 0)
                                                    data-range-value-low="{{ $products->min('unit_price') }}"
                                                @else
                                                    data-range-value-low="0"
                                                @endif
                                                id="input-slider-range-value-low">
                                        </div>

                                        <div class="col-6 text-right">
                                            <span class="range-slider-value value-high"
                                                @if (isset($max_price))
                                                    data-range-value-high="{{ $max_price }}"
                                                @elseif($products->max('unit_price') > 0)
                                                    data-range-value-high="{{ $products->max('unit_price') }}"
                                                @else
                                                    data-range-value-high="0"
                                                @endif
                                                id="input-slider-range-value-high">
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>


                    <div class="widget_list recent_product"> 
                        <h2>Filter by color</h2>
                        <div class="recent_product_container" >
                            <!-- Filter by color -->
                                <ul class="list-inline checkbox-color checkbox-color-circle mb-0" style="padding: 5px;">
                                    @foreach ($all_colors as $key => $color)


                                        <li>
                                            <input type="radio" id="color-{{ $key }}" name="color" value="{{ $color }}" @if(isset($selected_color) && $selected_color == $color) checked @endif onchange="filter()">
                                            <label style="background: {{ $color }};" for="color-{{ $key }}" data-toggle="tooltip" data-original-title="{{ \App\Color::where('code', $color)->first()->name }}"></label>
                                        </li>
                                    @endforeach
                                </ul>

                        </div>
                    </div>   

                    @foreach ($attributes as $key => $attribute)
                            @if (\App\Attribute::find($attribute['id']) != null)

                         
                                <div class="widget_list recent_product">
                                    
                                      <h2>  Filter by {{ \App\Attribute::find($attribute['id'])->name }} </h2>
                                 
                                    <div class="recent_product_container">
                                        <!-- Filter by others -->
                                        <div class="filter-checkbox">
                                            @if(array_key_exists('values', $attribute))
                                                @foreach ($attribute['values'] as $key => $value)
                                                    @php
                                                        $flag = false;
                                                        if(isset($selected_attributes)){
                                                            foreach ($selected_attributes as $key => $selected_attribute) {
                                                                if($selected_attribute['id'] == $attribute['id']){
                                                                    if(in_array($value, $selected_attribute['values'])){
                                                                        $flag = true;
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="attribute_{{ $attribute['id'] }}_value_{{ $value }}" name="attribute_{{ $attribute['id'] }}[]" value="{{ $value }}" @if ($flag) checked @endif onchange="filter()">
                                                        <label for="attribute_{{ $attribute['id'] }}_value_{{ $value }}">{{ $value }}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach





                    <div class="widget_list recent_product">
                        <h2>Top Rated Products</h2>
                        <div class="recent_product_container">

                            @foreach(\App\Product::orderBy('rating','desc')->where('published', 1)->take(4)->get() as $key => $product)

                            <div class="recent_product_list">
                                <div class="recent_product_thumb">
                                    <a href="{{ route('product', $product->slug) }}"><img src="{{ asset($product->featured_img) }}" alt="{{ __($product->name) }}"></a>
                                </div>
                                <div class="recent_product_content">
                                    <h3><a href="{{ route('product', $product->slug) }}" class="text-truncate" style="display: block;padding-right: 10px;">{{$product->name}}</a></h3>

                                    <div class="price_box">
                                       @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                        <span class="old_price">{{ home_base_price($product->id) }}</span>
                                        @endif
                                        <span class="current_price">{{ home_discounted_base_price($product->id) }}</span>
                                    </div>
                                </div>
                            </div>

                            @endforeach
            
                        </div>
                    </div>

                </aside>
                <!--sidebar widget end-->
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <!--shop wrapper start-->
                <!--shop toolbar start-->

                    @if(isset($category_id))
                            @php
                                $banners = \App\Category::find($category_id)->banner;
                            @endphp
                              
                            @if(is_array(json_decode($banners)))
                             <div class="mb-3 d-none d-lg-block">
                                <section class="slider_section">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12 ">
                                                    <div class="slider_area slider_two owl-carousel">
                                                      @foreach (json_decode($banners) as $key => $banner)
                                                        <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset($banner) }}">
                                                            <div class="slider_content slider_content_two content_position_center">
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                </section>
                                 <div class="trending-category category-listing d-none d-lg-block">
                                    <ul>
                                        @foreach (\App\SubCategory::where('category_id', $category_id)->get() as $key => $subcategory)
                                            <li @if ($key == 0) class="active" @endif>
                                                <div class="trend-category-single">
                                                    <a href="{{ route('products.subcategory', $subcategory->slug) }}"
                                                       class="d-block" title="{{__($subcategory->name)}}">
                                                        <div class="name">{{ __($subcategory->name) }}</div>
                                                                                                        </a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                         @endif
                @endif  



                    @isset($category_id)
                        <input type="hidden" name="category" value="{{ \App\Category::find($category_id)->slug }}">
                    @endisset
                    @isset($subcategory_id)
                        <input type="hidden" name="subcategory" value="{{ \App\SubCategory::find($subcategory_id)->slug }}">
                    @endisset
                    @isset($subsubcategory_id)
                        <input type="hidden" name="subsubcategory" value="{{ \App\SubSubCategory::find($subsubcategory_id)->slug }}">
                    @endisset

               <!-- serach section -->


                      <div class="sort-by-bar row no-gutters bg-white mb-3 px-3 pt-2">
                            <div class="col-xl-4 d-flex d-xl-block justify-content-between align-items-end ">
                                <div class="sort-by-box flex-grow-1">
                                    <div class="form-group">
                                        <label>{{__('Search')}}</label>
                                        <div class="search-widget">
                                            <input class="form-control input-lg" type="text" name="q"
                                                   placeholder="{{__('Search products')}}"
                                                   @isset($query) value="{{ $query }}" @endisset>
                                            <button type="submit" class="btn-inner">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-xl-none ml-3 form-group">
                                    <button type="button" class="btn p-1 btn-sm" id="side-filter">
                                        <i class="la la-filter la-2x"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xl-7 offset-xl-1">
                                <div class="row no-gutters">
                                    <div class="col-4">
                                        <div class="sort-by-box px-1">
                                            <div class="form-group">
                                                <label>{{__('Sort by')}}</label>
                                                <select class="form-control sortSelect"
                                                        data-minimum-results-for-search="Infinity" name="sort_by"
                                                        onchange="filter()">
                                                    <option value="1"
                                                            @isset($sort_by) @if ($sort_by == '1') selected @endif @endisset>{{__('Newest')}}</option>
                                                    <option value="2"
                                                            @isset($sort_by) @if ($sort_by == '2') selected @endif @endisset>{{__('Oldest')}}</option>
                                                    <option value="3"
                                                            @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset>{{__('Price low to high')}}</option>
                                                    <option value="4"
                                                            @isset($sort_by) @if ($sort_by == '4') selected @endif @endisset>{{__('Price high to low')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="sort-by-box px-1">
                                            <div class="form-group">
                                                <label>{{__('Brands')}}</label>
                                                <select class="form-control sortSelect"
                                                        data-placeholder="{{__('All Brands')}}" name="brand"
                                                        onchange="filter()">
                                                    <option value="">{{__('All Brands')}}</option>
                                                    @foreach (\App\Brand::all() as $brand)
                                                        <option value="{{ $brand->slug }}"
                                                                @isset($brand_id) @if ($brand_id == $brand->id) selected @endif @endisset>{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="sort-by-box px-1">
                                            <div class="form-group">
                                                <label>{{__('Sellers')}}</label>
                                                <select class="form-control sortSelect"
                                                        data-placeholder="{{__('All Sellers')}}" name="seller_id"
                                                        onchange="filter()">
                                                    <option value="">{{__('All Sellers')}}</option>
                                                    @foreach (\App\Seller::all() as $key => $seller)
                                                        @if ($seller->user != null && $seller->user->shop != null)
                                                            <option value="{{ $seller->id }}"
                                                                    @isset($seller_id) @if ($seller_id == $seller->id) selected @endif @endisset>{{ $seller->user->shop->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                

                <!-- serach section end -->

                <input type="hidden" name="min_price" value="">
                <input type="hidden" name="max_price" value="">


                <div class="shop_title">
                    <h1>Recommended For You</h1>
                </div>
                <!--shop toolbar end-->

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

                <div class="products-pagination bg-white p-3">
                            <nav aria-label="Center aligned pagination">
                                <ul class="pagination justify-content-center">
                                    {{ $products->links() }}
                                </ul>
                            </nav>
                        </div>
                <!--shop toolbar end-->
                <!--shop wrapper end-->
            </div>
        </div>
    </div>
</form>
</div>
<!--shop  area end-->



@endsection

@section('script')
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }

        // Bootstrap selected
$(".sortSelect").each(function (index, element) {
    $(".sortSelect").select2({
        theme: "default sortSelectCustom",
    });
});
    </script>
@endsection