<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderpartial extends Model
{
    protected $fillable = ["order_id","product_id","user_id","qty","action_by"];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    function scopeCountProductQty($model, $product){
        return $model->where([
            "product_id"=>$product->product_id,
            "order_id"=>$product->order_id
        ])->sum('qty');
    }

}
