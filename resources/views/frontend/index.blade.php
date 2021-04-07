 @extends('frontend.layouts.app')

 @section('content')

<!--slider area start-->
    <section class="slider_section mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-3">
                    <div class="slider_area slider_two owl-carousel">

                       @foreach (\App\Slider::where('published', 1)->get() as $key => $slider)
                        <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset($slider->photo) }}">
                            <div class="slider_content slider_content_two content_position_center">
                                <h1>The NX-80 </h1>
                                <span>High-Fidelity Sound that takes <br> your breath away </span>
                                <h2><span>form</span> $99  <span>00</span></h2>
                                <a href="/{{ $slider->link }}" target="_blank">shop now</a> 
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> 

    </section>

    <!--slider area end-->

    <!--new product area start-->
    <section class="new_product_area mb-50">
        <div class="container">
            <div class="new_product_three_container">
                <div class="row">

                    @php
                        $flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->first();
                    @endphp

                    <div class="@if($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date) col-lg-9 col-md-12 @else col-lg-12 col-md-12 @endif">
                        <div class="section_title section_title_two">
                            <h2>New Products</h2>
                        </div>
                        <div class="product_carousel product_column3 owl-carousel">

                            @foreach (\App\Product::orderBy('id','desc')->where('published', 1)->take(5)->get() as $key => $product)
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a href="{{ route('product', $product->slug) }}"><img src="{{ asset($product->flash_deal_img) }}" alt="{{ __($product->name) }}"></a>

                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="{{ route('product', $product->slug) }}" class="text-truncate" style="display: block;padding-left:10px;padding-right: 10px;">{{$product->name}} </a></h3>
                                    </div>
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

                       

                    @if($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date)
   

                    <div class="col-lg-3 col-md-12">
                        <div class="deals_sidebar_product">
                            <div class="section_title section_title_two">
                                <h2>Hot deals</h2>
                            </div>
                            <div class="deals_product_column1 owl-carousel">

                                @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                                @php
                                    $product = \App\Product::find($flash_deal_product->product_id);
                                @endphp
                                @if ($product != null && $product->published != 0)

                                <div class="deals_product_list">
                                    <div class="product_thumb">
                                        <a href="{{ route('product', $product->slug) }}"><img src="{{ asset($product->featured_img) }}" alt="{{ __($product->name) }}"></a>
                                        <div class="label_product">
                                            <span class="label_sale">sale</span>
                                        </div>

                                    </div>
                                    <div class="product_content">
                                        <div class="product_name">
                                            <h3><a href="{{ route('product', $product->slug) }}">{{$product->name}}</a></h3>
                                        </div>
                                        <div class="price_box">

                                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                            <span class="old_price">{{ home_base_price($product->id) }}</span>
                                            @endif
                                            <span class="current_price">{{ home_discounted_base_price($product->id) }}</span>
                                            
                                        </div>
                                        <div class="product_timing_six">
                                            <div data-countdown="{{ date('m/d/Y', $flash_deal->end_date) }}"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                @endif
                            @endforeach

                            </div>
                        </div>
                    </div>

                    @endif

                </div>
            </div>
        </div>
    </section>
    <!--new product area end-->

    <!--banner area start-->
    <div class="banner_area banner_column2 mb-50">
        <div class="container">
            <div class="row">
                 @foreach (\App\Banner::where('position', 1)->where('published', 1)->get() as $key => $banner)
                <div class="col-lg-{{ 12/count(\App\Banner::where('position', 1)->where('published', 1)->get()) }}">
                    <div class="single_banner">
                        <div class="banner_thumb">
                            <a href="{{ $banner->url }}"><img src="{{ asset($banner->photo) }}" alt="{{ env('APP_NAME') }} promo" style="object-fit: cover;width: 100%;height: 100%"></a>
                        </div>
                    </div>
                </div>
                 @endforeach
              
            </div>
        </div>
    </div>
    <!--banner area end-->

    @foreach (\App\HomeCategory::where('status', 1)->get() as $key => $homeCategory)

    <!--home product area start-->
    <section class="home_product_area product_color_seven mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_header">
                        <div class="section_title section_title_seven">
                            <h2>{{ __($homeCategory->category->name) }} </h2>
                        </div>
                        <div class="product_tab_button button_color">
                            <ul class="nav" role="tablist">
                                @foreach (json_decode($homeCategory->subsubcategories) as $key => $subsubcategory)
                              @if (\App\SubSubCategory::find($subsubcategory) != null)
                                <li >
                                    <a class="@php if($key == 0) echo 'active'; @endphp" data-toggle="tab" href="#subsubcat-{{ $subsubcategory }}" role="tab" aria-controls="Bedroom7" aria-selected="false">
                                      {{ __(\App\SubSubCategory::find($subsubcategory)->name) }}
                                    </a>
                                </li>
                                @endif
                            @endforeach  
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row home_product_reverse">
                <div class="col-lg-3 col-md-12">
                    <div class="single_banner">
                        <div class="banner_thumb" style="height: 330px">
                            <a href="{{ route('products.category', $homeCategory->category->slug) }}"><img src="{{ asset($homeCategory->category->thumbnail) }}" alt="" style="object-fit: cover;max-width: 100%;height: 100%"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 p-0">
                    <div class="tab-content">

                        @foreach (json_decode($homeCategory->subsubcategories) as $key => $subsubcategory)
                        @if (\App\SubSubCategory::find($subsubcategory) != null)
                        <div class="tab-pane fade @php if($key == 0) echo 'show active'; @endphp" id="subsubcat-{{ $subsubcategory }}" role="tabpanel">
                            <div class="product_carousel product_style7 product_column3 owl-carousel">

                                @foreach (filter_products(\App\Product::where('published', 1)->where('subsubcategory_id', $subsubcategory))->limit(6)->get() as $key => $product)
                                
                                <div class="col-lg-3">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a href="{{ route('product', $product->slug) }}"><img src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}"></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_name">
                                                <h3><a href="{{ route('product', $product->slug) }}" class="text-truncate" style="display: block;padding-left:10px;padding-right: 10px;">{{ __($product->name) }}</a></h3>
                                            </div>

                                            <div class="price_box">
                                                @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                <span class="old_price">{{ home_base_price($product->id) }}</span>
                                                @endif
                                                <span class="current_price">{{ home_discounted_base_price($product->id) }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                @endforeach
                                
                            </div>
                        </div>

                        @endif

                        @endforeach   
                    </div>
                </div>

            </div>
        </div>
    </section>

    @endforeach


    

    <!-- <div id="section_home_categories">

    </div> -->


    <section class="just_for_you mb-50">
        <div class="container">
            <div class="row ">
                <div class="col-12">
                    <div class="product_header">
                        <div class="section_title section_title_seven">
                            <h2>Just For You</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row ">
                @foreach(filter_products(\App\Product::where('published', 1)->where('featured', '1'))->get()->take(12) as $key => $product)
                    <div class="col-lg-2 col-md-3 col-6">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a href="{{ route('product', $product->slug) }}"><img src="{{ asset($product->thumbnail_img) }}" alt="{{$product->name}}"></a>
                            </div>
                            <div class="product_content">
                                <div class="product_name">
                                    <h3><a href="{{ route('product', $product->slug) }}" class="text-truncate" style="display: block;padding-left:10px;padding-right: 10px;">{{$product->name}}</a></h3>
                                </div>
                                <div class="price_box">
                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                     <span class="old_price">{{ home_base_price($product->id) }}</span>
                                     @endif
                                    <span class="current_price">{{ home_discounted_base_price($product->id) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach 
            </div>
        </div>
    </section>


 @endsection

@section('script')
    <script>
        $(document).ready(function(){
          
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                slickInit();
            });

          
        });
    </script>
@endsection