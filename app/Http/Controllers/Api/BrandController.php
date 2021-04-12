<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BrandCollection;
use App\Models\Brand;

class BrandController extends Controller
{

    public function __construct(ResponseController $response){
        $this->response = $response;
    }
    
    public function index()
    {
       $brands  =  new BrandCollection(Brand::all());

        
        if(! $brands){
            return $this->response->error([
                'message'=>"Setting not added yet",
                'data'=>null
            ]);
        }

        return $brands;

    }

    public function top()
    {
        return new BrandCollection(Brand::where('top', 1)->get());
    }
}
