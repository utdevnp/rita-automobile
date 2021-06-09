<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderpartial extends Model
{
    protected $fillable = ["order_id","product_id","user_id","qty","action_by"];
}
