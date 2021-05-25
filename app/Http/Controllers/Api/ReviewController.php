<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ReviewCollection;
use App\Models\Review;
use Illuminate\Http\Request;
use Validator;
class ReviewController extends Controller
{

    public function __construct(ResponseController $response){
        $this->response = $response;
    }

    public function index($id)
    {
        if(empty($id)){
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>['product_id'=>"Product id is required."]
            ]);
        }

        return new ReviewCollection(Review::where('product_id', $id)->latest()->get());
    }

    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'product_id' => 'required|numeric|exists:products,id',
            'user_id' => 'required|numeric|exists:users,id',
            "rating"=>"required"
          ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }

        $review  = Review::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return $this->response->success([
            'message'=>"Your review has been posted successfully",
            'data'=>$review
        ]);

    }
}
