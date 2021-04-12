<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryCollection;
use App\Models\BusinessSetting;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct(ResponseController $response){
        $this->response = $response;
    }

    public function index()
    {
        $category =  new CategoryCollection(Category::all());

        if(! $category){
            return $this->response->error([
                'message'=>"Category listing fail",
                'data'=>null
            ]);
        }

        return $category;
    }

    public function featured()
    {
        $category  =  new CategoryCollection(Category::where('featured', 1)->get());

        if(! $category){
            return $this->response->error([
                'message'=>"Category listing fail",
                'data'=>null
            ]);
        }

        return  $category;

    }

    public function home()
    {
        $homepageCategories = BusinessSetting::where('type', 'category_homepage')->first();

        if(! $homepageCategories){
            if(! $homepageCategories){
                return $this->response->error([
                    'message'=>"Category listing fail",
                    'data'=>null
                ]);
            }
        }else{
            $homepageCategories = json_decode($homepageCategories->value);
            $categories = json_decode($homepageCategories->category);
            return  new CategoryCollection(Category::find($categories));
        }
       
    }
}
