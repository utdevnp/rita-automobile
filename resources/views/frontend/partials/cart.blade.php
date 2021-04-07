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