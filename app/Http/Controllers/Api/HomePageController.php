<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomePageCollection;
use App\Models\Category;
class HomePageController extends Controller
{
    public function __construct(ResponseController $response){
        $this->response = $response;
    }

    public function index(){
         $homepage =  new HomePageCollection(Category::where('featured', 1)->get());

        if(! $homepage){
            return $this->response->error([
                'message'=>"homepagedata listing fail",
                'data'=>null
            ]);
        }

        return $homepage;
    }
}
