<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryCollection;
use App\Models\BusinessSetting;
use App\Models\Category;
use App\Models\SubCategory;
use App\SubSubCategory;

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


    function getAllCategory(){
        $category= Category::all();

        if(count( $category)>0){
            $newArray = [];
            foreach($category as $cat => $value){

                $getSubCategory   = SubCategory::where('category_id', $value['id'])->get();

                $newArray[$cat] = $value;
                $newArray[$cat]['subcategory'] = $getSubCategory;
                foreach($getSubCategory as $key =>  $subcatvalue){
                    $newArray[$cat]['subcategory'][$key]['sub_subcategory'] = SubSubCategory::where("sub_category_id",$subcatvalue['id'])->get();
                }
            }

            return $this->response->success([
                'message'=>"Category listed successful",
                'data'=>$newArray
            ]);
        }else{
            return $this->response->error([
                'message'=>"Category listing fail",
                'data'=>null
            ]);
        }
    }
}
