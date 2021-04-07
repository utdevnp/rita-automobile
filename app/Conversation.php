<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['product_id', 'sender_id', 'receiver_id', 'title'];

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
