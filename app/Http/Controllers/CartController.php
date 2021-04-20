<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\SubSubCategory;
use App\Category;
use Session;
use App\Color;

class CartController extends Controller
{
    public function index(Request $request)
    {
        //dd($cart->all());
        $categories = Category::all();
        return view('front.page.cart', compact('categories'));
    }

    public function showCartModal(Request $request)
    {
        $product = Product::find($request->id);

        return view('front.page.addToCart', compact('product')); 
    }

    public function updateNavCart(Request $request)
    {
        
        return   view('front.partial.cart');
    }

    public function addToCart(Request $request)
    {
        //dd($request->all());
        $product = Product::find($request->id);

        $data = array();
        $data['id'] = $product->id;
        $str = '';
        $tax = 0;

        //check the color enabled or disabled for the product
        if($request->has('color')){
            $data['color'] = $request['color'];
            $str = Color::where('code',$request['color'])->first()->name;
        }

        //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
        // foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
        //     if($str != null){
        //     else{
        //         $str .= str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
        //     }
        //         $str .= '-'.str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
        //     }
        // }

        $data['variant'] = $str;

        if($str != null && $product->variant_product){
            $product_stock = $product->stocks->where('variant', $str)->first();
            $price = $product_stock->price;
            $quantity = $product_stock->qty;

            if($quantity >= $request['quantity']){
                 $variations->$str->qty -= $request['quantity'];
                 $product->variations = json_encode($variations);
                 $product->save();
            }
            else{
                return view('frontend.partials.outOfStockCart');
            }
        }
        else{
            $price = $product->unit_price;
        }

        //discount calculation based on flash deal and regular discount
        //calculation of taxes
        $flash_deals = \App\FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1  && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
                $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $price -= ($price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }
        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        if($product->tax_type == 'percent'){
            $tax = ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $tax = $product->tax;
        }

        $data['quantity'] = $request['quantity'];
        $data['price'] = $price;
        $data['tax'] = $tax;
        $data['shipping'] = $product->shipping_cost;

        if($request->session()->has('cart')){
            $foundInCart = false;
            $cart = collect();

            foreach ($request->session()->get('cart') as $key => $cartItem){
                if($cartItem['id'] == $request->id){
                    if($cartItem['variant'] == $str){
                        $foundInCart = true;
                        $cartItem['quantity'] += $request['quantity'];
                    }
                }
                $cart->push($cartItem);
            }

            if (!$foundInCart) {
                $cart->push($data);
            }
            $request->session()->put('cart', $cart);
        }
        else{
            
            $cart = collect([$data]);
            $request->session()->put('cart', $cart);
        }

        return view('frontend.partials.addedToCart', compact('product', 'data'));
    }

    //removes from Cart
    public function removeFromCart(Request $request)
    {
      
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart', collect([]));
            $cart->forget($request->key);
            $request->session()->put('cart', $cart);
        }

        return view('front.partial.cart');
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
     
        $cart = $request->session()->get('cart', collect([]));
        
       //  dd($cart);

        $cart = $cart->map(function ($object, $key) use ($request) {
      
            if($key == $request->key['quantity']){
                $object['quantity'] = $request->quantity;
            }
            
            return $object;
        });
       // dd($cart);
        $request->session()->put('cart', $cart);

        return redirect()->route("cart"); //view('front.page.cart');
    }
}
