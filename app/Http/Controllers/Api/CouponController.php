<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CouponCollection;
use App\Models\CouponUsage;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Resource;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function apply(Request $request) {
        $coupon = Coupon::where('code', $request->code)->latest()->get();

        if(count($coupon) > 0) {
            foreach($coupon as $c) {
                $couponusage = CouponUsage::where('user_id', $request->user_id)->where('coupon_id', $c->id)->count();

                if ($couponusage > 0) { // coupon already used by this user
                    return response()->json([
                        'success' => true,
                        'status' => 201,
                        'message' => 'This coupon has already been used by user'
                    ]);
                } else {
                    return new CouponCollection($coupon);
                }
            }
        } else {
            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Coupon doesnot exists'
            ]);
        }
    }
}
