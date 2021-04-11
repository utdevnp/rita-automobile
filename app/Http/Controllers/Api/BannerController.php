<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BannerCollection;
use App\Models\Banner;
use App\Http\Controllers\Api\ResponseController;
class BannerController extends Controller
{
    public function __construct(ResponseController $response){
        $this->response = $response;
    }



    public function index()
    {
        $Banners =   new BannerCollection(Banner::all());

       

        if(! $Banners){
            return $this->response->error([
                'message'=>"Banner not added yet",
                'data'=>null
            ]);
        }
        return $Banners;

    }
}
