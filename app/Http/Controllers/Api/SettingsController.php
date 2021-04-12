<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SettingsCollection;
use App\Models\AppSettings;

class SettingsController extends Controller
{

    public function __construct(ResponseController $response){
        $this->response = $response;
    }
    
    public function index()
    {
       $setting  =  new SettingsCollection(AppSettings::all());


        if(! $setting){
            return $this->response->error([
                'message'=>"Setting not added yet",
                'data'=>null
            ]);
        }

        return $setting;

    }
}
