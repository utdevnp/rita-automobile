<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CouponCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'type' => $data->type,
                    'code' => $data->code,
                    'details' => json_decode($data->details),
                    'start_date' => $data->start_date,
                    'discount' => $data->discount,
                    'discount_type' => $data->discount_type,
                    'end_date' => $data->end_date,
                    'time' => $data->created_at->diffForHumans()
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
