<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\FlashDealProduct;
use App\Flash;
class Product extends Model
{
    protected $fillable = [
        'name','added_by', 'user_id', 'category_id', 'subcategory_id', 'subsubcategory_id', 'brand_id', 'video_provider', 'video_link', 'unit_price',
        'purchase_price', 'unit', 'slug', 'colors', 'choice_options', 'variations', 'current_stock',"part_no","segment_id","model_id","smart_part_no",
        "ref_part_no","oe_part_no","size","mega_categories","series"
      ];
    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function subcategory(){
    	return $this->belongsTo(SubCategory::class);
    }

    public function subsubcategory(){
    	return $this->belongsTo(SubSubCategory::class);
    }

    public function brand(){
    	return $this->belongsTo(Brand::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function orderDetails(){
    return $this->hasMany(OrderDetail::class);
    }

    public function reviews(){
    return $this->hasMany(Review::class)->where('status', 1);
    }

    public function wishlists(){
    return $this->hasMany(Wishlist::class);
    }

    public function stocks(){
    return $this->hasMany(ProductStock::class);
    }
    public function flashes(){
        return $this->hasMany(Flash::class);
    }
      public function flash_deals_products(){
        return $this->hasMany(FlashDealProduct::class);
    }
}

