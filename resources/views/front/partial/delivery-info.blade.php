
                                    <h3>Delivery Details </h3>
                                    <div class="row">

                                        <div class="col-lg-12 mb-20">
                                           
                                            


                                    @csrf
                            @php
                                $admin_products = array();
                                $seller_products = array();
                                foreach (Session::get('cart') as $key => $cartItem){
                                    if(\App\Product::find($cartItem['id'])->added_by == 'admin'){
                                        array_push($admin_products, $cartItem['id']);
                                    }
                                    else{
                                        $product_ids = array();
                                        if(array_key_exists(\App\Product::find($cartItem['id'])->user_id, $seller_products)){
                                            $product_ids = $seller_products[\App\Product::find($cartItem['id'])->user_id];
                                        }
                                        array_push($product_ids, $cartItem['id']);
                                        $seller_products[\App\Product::find($cartItem['id'])->user_id] = $product_ids;
                                    }
                                }
                            @endphp

                            @if (!empty($admin_products))
                            <div class="card mb-3">
                                <div class="card-header bg-white py-3">
                                    <h5 class="heading-6 mb-0">{{ \App\GeneralSetting::first()->site_name }} Products</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table-cart">
                                                <tbody>
                                                    @foreach ($admin_products as $key => $id)
                                                    <tr class="cart-item">
                                                        <td class="product-image" width="25%">
                                                            <a href="{{ route('product', \App\Product::find($id)->slug) }}" target="_blank">
                                                                <img loading="lazy"  src="{{ asset(\App\Product::find($id)->thumbnail_img) }}">
                                                            </a>
                                                        </td>
                                                        <td class="product-name strong-600">
                                                            <a href="{{ route('product', \App\Product::find($id)->slug) }}" target="_blank" class="d-block c-base-2">
                                                                {{ \App\Product::find($id)->name }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="d-flex align-items-center p-3 border rounded gry-bg c-pointer">
                                                        <input type="radio" name="shipping_type_admin" value="home_delivery" checked class="d-none" onchange="show_pickup_point(this)" data-target=".pickup_point_id_admin">
                                                        <span class="radio-box"></span>
                                                        <span class="d-block ml-2 strong-600">
                                                            {{ __('Home Delivery') }}
                                                        </span>
                                                    </label>
                                                </div>
                                                @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="d-flex align-items-center p-3 border rounded gry-bg c-pointer">
                                                            <input type="radio" name="shipping_type_admin" value="pickup_point" class="d-none" onchange="show_pickup_point(this)" data-target=".pickup_point_id_admin">
                                                            <span class="radio-box"></span>
                                                            <span class="d-block ml-2 strong-600">
                                                                {{ __('Local Pickup') }}
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>

                                            @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                                <div class="mt-3 pickup_point_id_admin d-none">
                                                    <select class="pickup-select form-control-lg w-100" name="pickup_point_id_admin" data-placeholder="Select a pickup point">
                                                            <option>{{__('Select your nearest pickup point')}}</option>
                                                        @foreach (\App\PickupPoint::where('pick_up_status',1)->get() as $key => $pick_up_point)
                                                            <option value="{{ $pick_up_point->id }}" data-address="{{ $pick_up_point->address }}" data-phone="{{ $pick_up_point->phone }}">
                                                                {{ $pick_up_point->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif                                  
                                            
                                        </div>	    	    	    	    	    	    
                                    </div>



                                    