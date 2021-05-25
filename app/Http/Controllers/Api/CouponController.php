<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CouponCollection;
use App\Models\CouponUsage;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Resource;
use App\Models\Coupon;
use Validator;
class CouponController extends Controller
{

    public function __construct(ResponseController $response){
        $this->response = $response;
    }

    public function apply(Request $request) {

        $validateData = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:users,id',
            'code'=>'required|exists:coupons,code',
          ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }


        $coupon = Coupon::where('code', $request->code)->latest()->get();

        if(count($coupon) > 0) {
            foreach($coupon as $c) {
                $couponusage = CouponUsage::where('user_id', $request->user_id)->where('coupon_id', $c->id)->count();

                if ($couponusage > 0) { // coupon already used by this user
                    
                    return $this->response->error([
                        'message'=>"This coupon has already been used by user",
                        'data'=>$couponusage
                    ]);

                } else {
                    return new CouponCollection($coupon);
                }
            }
        } else {
            return $this->response->error([
                'message'=>"Coupon doesnot exists",
                'data'=>$coupon
            ]);

        }
    }
}
