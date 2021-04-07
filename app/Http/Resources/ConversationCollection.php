<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Message;

class ConversationCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'product_id' => $data->product_id,
                    'title' => $data->title,
                    'sender_id' => $data->sender_id,
                    'receiver_id' => $data->receiver_id,
                    'sender_viewed' => $data->sender_viewed,
                    'receiver_viewed' => $data->receiver_viewed,
                    'created_at' => $data->created_at->diffForHumans(),
                    'updated_at' => $data->updated_at->diffForHumans(),
                    'message' => Message::where('conversation_id', $data->id)->get()
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
