<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CartCollection;
use App\Models\Cart;
use App\Models\Color;
use App\Models\FlashDeal;
use App\Models\FlashDealProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
class CartController extends Controller
{
    function __construct(ResponseController $response){
        $this->response = $response;
    }

    public function index($id)
    {
        if(empty($id) && !(int)$id){
            return $this->response->error([
                'message'=>"Validation error",
                'data'=>[
                    "id"=> "user Id is required"
                ]
            ]);
        }
        return new CartCollection(Cart::where('user_id', $id)->latest()->get());
    }

    public function add(Request $request)
    {
     
        $validateData = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'id' => 'required|numeric|exists:products,id',
          ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }


        $product = Product::findOrFail($request->id);
       
        $variant = $request->variant;
        $color = $request->color;
        $tax = 0;

        if ($variant == '' && $color == '')
            $price = $product->unit_price;
        else {
            //$variations = json_decode($product->variations);
            $product_stock = $product->stocks->where('variant', $variant)->first();
            $price = $product_stock->price;
        }

        //discount calculation based on flash deal and regular discount
        //calculation of taxes
        $flash_deals = FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1  && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
                $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
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

        if ($product->tax_type == 'percent') {
            $tax = ($price * $product->tax) / 100;
        }
        elseif ($product->tax_type == 'amount') {
            $tax = $product->tax;
        }

        $cart = Cart::updateOrCreate([
            'user_id' => $request->user_id,
            'product_id' => $request->id,
            'variation' => $variant
        ], [
            'price' => $price,
            'tax' => $tax,
            'shipping_cost' => $product->shipping_type == 'free' ? 0 : $product->shipping_cost,
            'quantity' => DB::raw('quantity + 1')
        ]);

        return $this->response->success([
            'message'=>"Product added to cart successfully",
            'data'=>$cart
        ]);


    }

    public function changeQuantity(Request $request)
    {

         $validateData = Validator::make($request->all(), [
            'quantity' => 'required|numeric',
            'id' => 'required|numeric|exists:carts,id',
          ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }

        $cart = Cart::findOrFail($request->id);
        $cart->update([
            'quantity' => $request->quantity
        ]);

        return $this->response->success([
            'message'=>"'Cart updated successfully",
            'data'=>$cart
        ]);

    }

    public function destroy($id)
    {
        if(empty($id) && !(int)$id){
            return $this->response->error([
                'message'=>"Validation error",
                'data'=>[
                    "id"=> "Cart Id is required"
                ]
            ]);
        }

        Cart::destroy($id);

        return $this->response->success([
            'message'=>"Product is successfully removed from your cart",
            'data'=>[]
        ]);

        
    }
}
