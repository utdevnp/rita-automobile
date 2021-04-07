<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class FlashDeal extends Model
{
   
    public function flash_deal_products()
    {
        return $this->hasMany(FlashDealProduct::class);
    }


    public function products(){
    	return $this->hasMany(Product::class);
    }





}
