<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SubCategoryCollection;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function __construct(ResponseController $response){
        $this->response = $response;
    }

    public function index($id)
    {
        $subcategory =  new SubCategoryCollection(SubCategory::where('category_id', $id)->get());

        if(! $subcategory){
            return $this->response->error([
                'message'=>"Category listing fail",
                'data'=>null
            ]);
        }

        return $subcategory;

    }
}
