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
                            <a href="{{ route('products.category', $homeCategory->category->slug) }}"><img src="{{ asset($homeCategory->category->banner) }}" alt="" style="object-fit: cover;max-width: 100%;height: 100%"></a>
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
                                                <h3><a href="{{ route('product', $product->slug) }}" sclass="text-truncate" style="display: block;padding-left:10px;padding-right: 10px;">{{ __($product->name) }}</a></h3>
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
