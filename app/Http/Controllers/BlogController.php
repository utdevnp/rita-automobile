<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attribute;
use CoreComponentRepository;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("frontend.blog");
    }
    
}
