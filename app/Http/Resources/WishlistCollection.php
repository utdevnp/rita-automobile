<?php

namespace App\Http\Resources;

use App\Models\Review;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WishlistCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => (integer) $data->id,
                    'product' => [
                        'id' => $data->product,
                        // 'name' => $data->product->name,
                        // 'photos' => json_decode($data->product->photos),
                        // 'thumbnail_image' => $data->product->thumbnail_img,
                        // 'flash_image' => $data->product->featured_img,
                        // 'flash_deal_image' => $data->product->flash_deal_img,
                        // 'base_price' => (double) homeBasePrice($data->product->id),
                        // 'base_discounted_price' => (double) homeDiscountedBasePrice($data->product->id),
                        // 'todays_deal' => (integer) $data->product->todays_deal,
                        // 'featured' =>(integer) $data->product->featured,
                        // 'current_stock' => (integer) $data->product->current_stock,
                        // 'unit' => $data->product->unit,
                        // 'current_stock' => $data->product->current_stock,
                        // 'discount' => (double) $data->product->discount,
                        // 'discount_type' => $data->product->discount_type,
                        // 'rating' => (double) $data->product->rating,
                        // 'sales' => (integer) $data->product->num_of_sale,
                        // 'video_provider' => $data->product->video_provider,
                        // 'video_link' => $data->product->video_link,
                        // 'review_count' => (integer) Review::where(['product_id' => $data->id])->count(),
                        // 'links' => [
                        //     'details' => route('products.show', $data->product->id),
                        //     'reviews' => route('api.reviews.index', $data->product->id),
                        //     'related' => route('products.related', $data->product->id),
                        //     'top_from_seller' => route('products.topFromSeller', $data->product->id)
                        // ]
                    ]
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
