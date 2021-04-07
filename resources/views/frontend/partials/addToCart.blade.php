<div class="modal-body p-4">
    <div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
        <div class="product_right_sidebar">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                           <div class="product-details-tab">
                                 @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)

                                <div id="img-1" class="zoomWrapper single-zoom">
                                    <a href="#">
                                        <img id="zoom1" src="{{ asset(json_decode($product->photos)[0]) }}" data-zoom-image="{{ asset(json_decode($product->photos)[0]) }}" alt="big-1">  
                                    </a>
                                </div>
                                <div class="single-zoom-thumb">
                                    <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">

                                        @foreach (json_decode($product->photos) as $key => $photo)
                                        <li>
                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{ asset($photo) }}" data-zoom-image="{{ asset($photo) }}">
                                                <img src="{{ asset($photo) }}" alt="zo-th-1"/>
                                            </a>
                                        </li>
                                        @endforeach
                                        <!-- <li >
                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{ asset('frontend/img/product/agricultural-sprayer-pump-500x500.jpg')}}" data-zoom-image="{{ asset('frontend/img/product/agricultural-sprayer-pump-500x500.jpg')}}">
                                                <img src="{{ asset('frontend/img/product/agricultural-sprayer-pump-500x500.jpg')}}" alt="zo-th-1"/>
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>

                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="product_d_right">
                                 @php
                    $qty = 0;
                    if($product->variant_product){
                        foreach ($product->stocks as $key => $stock) {
                            $qty += $stock->qty;
                        }
                    }
                    else{
                        $qty = $product->current_stock;
                    }
                @endphp
                               <form  id="option-choice-form"> 
                                          @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">

                                    <h1>  {{ __($product->name) }}</h1>
                                    <div class="price_box">
                                         @if(home_price($product->id) != home_discounted_price($product->id))
                                       <div class="row no-gutters mt-4">
                                                <div class="col-2">
                                                    <div class="product-description-label">{{__('Price')}}:</div>
                                                </div>
                                                <div class="col-10">
                                                    <span class="old_price">
                                                        <del>
                                                            {{ home_price($product->id) }}
                                                            <span>/{{ $product->unit }}</span>
                                                        </del>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row no-gutters mt-3">
                                                <div class="col-2">
                                                    <div class="product-description-label mt-1">{{__('Discount Price')}}:</div>
                                                </div>
                                                <div class="col-10">
                                                    <span class="current_price">
                                                        <strong>
                                                            {{ home_discounted_price($product->id) }}
                                                        </strong>
                                                        <span class="piece">/{{ $product->unit }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                         @else
                                       <div class="row no-gutters mt-3">
                                            <div class="col-2">
                                                <div class="product-description-label">{{__('Price')}}:</div>
                                            </div>
                                            <div class="col-10">
                                                <span class="current_price">
                                                    <strong>
                                                        {{ home_discounted_price($product->id) }}
                                                    </strong>
                                                    <span class="piece">/{{ $product->unit }}</span>
                                                </span>
                                            </div>
                                        </div>
                                         @endif

                                    </div>
                                  

                                   <div class="product_variant quantity">
                                        <label>quantity</label>
                                        <input min="1" max="100" value="1" type="number" name="quantity">
                                         <div class="avialable-amount" style="font-size: 13px;color: #777;overflow: hidden;text-overflow: ellipsis;">
                                            (<span id="available-quantity" >{{ $qty }}</span> {{__('available')}})
                                         </div>
                                    </div>
                                    <hr>

                                    <div class="row no-gutters pb-3" id="chosen_price_div">
                                        <div class="col-4">
                                            <div class="product-description-label">{{__('Total Price')}} :</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="product-price " >
                                                <strong id="chosen_price">

                                                </strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                        @if ($qty > 0)   
                                            <li class="add_to_cart"><a onclick="addToCart()" title="add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i> add to cart</a></li>
                                        @else
                                            <li class="wishlist"> 
                                            <button type="button" class="btn btn-styled btn-base-3 btn-icon-left strong-700" disabled>
                                                <i class="la la-cart-arrow-down"></i> {{__('Out of Stock')}}
                                            </button>
                                      </li>
                                        @endif
                                        </ul>
                                    </div>
                                   
                                </form>

                            </div>   
                        </div>
                    </div>
                </div>
    </div>
</div>

<script type="text/javascript">
    cartQuantityInitialize();
    $('#option-choice-form input').on('change', function(){
        getVariantPrice();
    });
</script>
