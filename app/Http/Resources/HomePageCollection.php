<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Product;
use App\Models\AppSettings;
class HomePageCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       //$this->collection->map(function($data) 
       foreach(Banner::all() as $model){
        $model['photo'] = 'public/' . $model['photo'];
     }

       return [
            "data"=>[
                "feature_category"=>Category::where('featured', 1)->get(),
                "banners"=>$model,
                "deal_of_day"=>Product::where('todays_deal', 1)->latest()->get(),
                //"setting"=> new SettingsCollection(AppSettings::all())
            ],
            
        ];

    }


    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200,
            'message' => "Home page listed successfully"
        ];
    }
}
