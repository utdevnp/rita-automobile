<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\BusinessSetting;
use App\User;
use DB;
use Validator;
class OrderController extends Controller
{

    public function __construct(ResponseController $response){
        $this->response = $response;
    }

    public function processOrder(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:users,id',
            "shipping_address"=>'required',
            "payment_type"=>'required',
            "payment_status"=>'required',
            "grand_total"=>'required',
            "coupon_discount"=>'required',
          ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }


        $shippingAddress = json_decode($request->shipping_address);
        // create an order
        $order = Order::create([
            'user_id' => $request->user_id,
            'shipping_address' => json_encode($shippingAddress),
            'payment_type' => $request->payment_type,
            'payment_status' => $request->payment_status,
            'grand_total' => (double) $request->grand_total - $request->coupon_discount,
            'coupon_discount' => $request->coupon_discount,
            'code' => date('Ymd-his'),
            'date' => strtotime('now')
        ]);

        $cartItems = Cart::where('user_id', $request->user_id)->get();

        if(count($cartItems)==0){

            return $this->response->error([
                'message'=>"Your cart is empty please add product in cart and proceed.",
                'data'=>[]
            ]);

        }
        // save order details
        foreach ($cartItems as $cartItem) {
            $product = Product::findOrFail($cartItem->product_id);
            if ($cartItem->variation) {
                $cartItemVariation = $cartItem->variation;
                $product_stocks = $product->stocks->where('variant', $cartItem->variation)->first();
                $product_stocks->qty -= $cartItem->quantity;
                $product_stocks->save();
            } else {
                $product->update([
                    'current_stock' => DB::raw('current_stock - ' . $cartItem->quantity)
                ]);
            }
            OrderDetail::create([
                'order_id' => $order->id,
                'seller_id' => $product->user_id,
                'product_id' => $product->id,
                'variation' => $cartItem->variation,
                'price' => $cartItem->price * $cartItem->quantity,
                'tax' => $cartItem->tax * $cartItem->quantity,
                'shipping_cost' => $cartItem->shipping_cost * $cartItem->quantity,
                'quantity' => $cartItem->quantity,
                'payment_status' => $request->payment_status,
                'shipping_type' => $request->shipping_type
            ]);
            $product->update([
                'num_of_sale' => DB::raw('num_of_sale + ' . $cartItem->quantity)
            ]);
        }
        // apply coupon usage
        if ($request->coupon_code != '') {
            CouponUsage::create([
                'user_id' => $request->user_id,
                'coupon_id' => Coupon::where('code', $request->coupon_code)->first()->id
            ]);
        }
        // calculate commission
        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
        foreach ($order->orderDetails as $orderDetail) {
            if ($orderDetail->product->user->user_type == 'seller') {
                $seller = $orderDetail->product->user->seller;
                $price = $orderDetail->price + $orderDetail->tax + $orderDetail->shipping_cost;
                $seller->update([
                    'admin_to_pay' => ($request->payment_type == 'cash_on_delivery') ? $seller->admin_to_pay - ($price * $commission_percentage) / 100 : $seller->admin_to_pay + ($price * (100 - $commission_percentage)) / 100
                ]);
            }
        }

        //  clear user's cart
        //  $user = User::findOrFail($request->user_id);
        // $user->carts()->delete();

        Cart::where('user_id', $request->user_id)->delete();
        $getRecentOrder = Order::where(['user_id'=>$request->user_id])->orderBy("id",'desc')->take(1)->get();
        return $this->response->success([
            'message'=>"Your order has been placed successfully",
            'data'=>$getRecentOrder
        ]);

    }

    public function store(Request $request)
    {
        return $this->processOrder($request);
    }
}
