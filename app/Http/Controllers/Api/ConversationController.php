<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ConversationCollection;
use App\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Resource;
use App\Product;
use App\Message;


class ConversationController extends Controller
{
    public function index(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:users,id',
          ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }


        return new ConversationCollection(Conversation::where('sender_id', $request->user_id)->orWhere('receiver_id', $request->user_id)->paginate(10));
    }

    public function store(Request $request)
    {

        $validateData = Validator::make($request->all(), [
            'product_id' => 'required|numeric|exists:products,id',
          ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }

        $product = Product::findOrFail($request->product_id);
        if(empty($request->title) || !isset($request->title))
            $request->title = $product->name;

        //        $conversation = Conversation::where('product_id', $request->product_id)->orWhere(function($query) use ($request) { $query->where('receiver_id', $request->user_id)->where('sender_id', $request->user_id);})->first();

        if(isset($request->conversation_id)) {
            $conversation_id = $request->conversation_id;
        } else {
            $conversation = Conversation::where('product_id', $request->product_id)->where('sender_id', $request->user_id)->first();
            if(!is_null($conversation))
                $conversation_id = $conversation->id;
        }

        if(!isset($conversation_id)) {
            $conversation = Conversation::create([
                'product_id' => $request->product_id,
                'sender_id' => $request->user_id,
                'receiver_id' => $product->user_id,
                'title' => $request->title,
            ]);
            $conversation_id = $conversation->id;
        }

        Message::create([
            'conversation_id' => $conversation_id,
            'user_id' => $request->user_id,
            'message' => $request->message,
        ]);

        return response()->json([
            'conversation_id' => $conversation_id,
            'success' => true,
            'status' => 200,
            'message' => 'Your message has been sent to seller'
        ]);
    }

    public function show(Request $request)
    {
        $conversation = Conversation::where('id', $request->id)->get();

        if($conversation) {

            foreach($conversation as $c) {
                if ($c->sender_id == $request->user_id) {
                    $c->sender_viewed = 1;
                } elseif ($c->receiver_id == $request->user_id) {
                    $c->receiver_viewed = 1;
                }
                $c->save();
            }

            return new ConversationCollection($conversation);
        }
    }

    public function showByProduct(Request $request)
    {
//        $conversation = Conversation::where('product_id', $request->product_id)->orWhere(function($query) use ($request) { $query->where('receiver_id', $request->user_id)->where('sender_id', $request->user_id);})->get();

        if(isset($request->conversation_id)) {
            $conversation_id = $request->conversation_id;
            $conversation = Conversation::where('id', $conversation_id)->get();
        } else {
            $conversation = Conversation::where('product_id', $request->product_id)->where('sender_id', $request->user_id)->get();
        }

        if($conversation) {
            foreach($conversation as $c) {
                if ($c->sender_id == $request->user_id) {
                    $c->sender_viewed = 1;
                } elseif ($c->receiver_id == $request->user_id) {
                    $c->receiver_viewed = 1;
                }
                $c->save();
            }

            return new ConversationCollection($conversation);
        }
    }

    public function destroy($id)
    {
        $conversation = Conversation::findOrFail($id);
        foreach ($conversation->messages as $key => $message) {
            $message->delete();
        }
        if(Conversation::destroy($id)){
            return response()->json([
                'message' => 'Conversation details deleted successfully'
            ], 200);
        }
    }

    public function remove(Request $request)
    {
        if(Message::destroy($request->message_id)){
            return response()->json([
                'message' => 'Message deleted successfully'
            ], 200);
        }
    }
}
