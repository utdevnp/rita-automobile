<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubSubCategory;

class HomeController extends Controller
{


    public function search($slug){
    	
        $subsubcategory_id = (SubSubCategory::where('slug', $request->subsubcategory)->first() != null) ? SubSubCategory::where('slug', $request->subsubcategory)->first()->id : null;}

    public function index(){

    	return view('front.home.index');
    }
    //
}
