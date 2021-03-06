<div class="row">
    <div class="col-md-12">
    <div class="order_table table-responsive">
<table>
        <thead>
            <tr>
                <th class="product_name">Product</th>
                <th class="product_quantity">Qty</th>
                <th class="product_total">Total</th>
            </tr>
        </thead>
        <tbody> @php

        

    $total = 0;
    $subtotal  =0; 
    $tax  =0;
    $shipping = 0;
    @endphp
    @foreach (Session::get('cart') as $key => $cartItem)
        @php
        $product = \App\Product::find($cartItem['id']);
        
        
        if($cartItem['quantity'] != null){
            if(count($cartItem['quantity'])>0){
                $quantity = $cartItem['quantity'][0];
            }else{
                $quantity  = $cartItem['quantity'];
            }
        }else{
            $quantity  = 1;
        }

        $shipping += $cartItem['shipping'] * $quantity;

        $tax += $cartItem['tax'] * $quantity;

        $total = $total + $cartItem['price'] * $quantity;
        
        $subtotal +=  $cartItem['price'] * $quantity;;

        $product_name_with_choice = $product->name;


        @endphp
            
        
            <tr>


            
            
                <td class="product_name"><a href="#">{{
                    $product->name
                }}</a></td>

                <td class="product_quantity">

                {{ $quantity }}

                </td>


                <td class="product_total">{{ single_price(($cartItem['price']+$cartItem['tax'])*$quantity) }}</td>


            </tr>
            
                @endforeach
        </tbody>
    </table>  

            </div>
    </div>
  


    <div class="coupon_area col-md-12 mb-2">
        <div class="row">
            
            <div class="col-lg-12 col-md-12 mb-2">
                <div class="coupon_code right">
            
                    <div class="coupon_inner">
                        <div class="cart_subtotal">
                            <p>Subtotal</p>
                            <p class="cart_amount">{{single_price($subtotal)}} </p>
                        </div>
                        <div class="cart_subtotal ">
                            <p>Shipping</p>
                            <p class="cart_amount"><span>Flat Rate:</span>{{single_price($shipping)}} </p>
                        </div>

                        @if (Session::has('coupon_discount'))
                            <div class="cart_subtotal ">
                                <p>Coupon Discount</p>
                                <span class="text-italic">{{ single_price(Session::get('coupon_discount')) }}</span>
                            </div>
                        @endif

                @php
                    $total = $subtotal+$tax+$shipping;
                    if(Session::has('coupon_discount')){
                        $total -= Session::get('coupon_discount');
                    }
                @endphp

                        <div class="cart_subtotal">
                            <p>Total</p>
                            <p class="cart_amount">{{single_price($total)}}</p>
                        </div>
                     
                    </div>
                </div>
            </div>

            @if (Auth::check() && \App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1)
            @if (Session::has('coupon_discount'))
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <div class="form-control bg-gray w-100">{{ \App\Coupon::find(Session::get('coupon_id'))->code }}</div>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Change Coupon')}}</button>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <input type="text" class="form-control w-100" name="code" placeholder="{{__('Have coupon code? Enter here')}}">
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Apply')}}</button>
                    </form>
                </div>
            @endif
        @endif
        

            <div class="col-lg-12 col-md-12 text-right">
               <button type="submit" class="btn btn-danger">Place Your Order  </button>
            </div>
        </div>
    </div>
</div>