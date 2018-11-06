<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontIndexController extends Controller
{

    public function homeIndex(){
        return view('front.home.home-content');
    }

    public function productCategory(){
        return view('front.category.category-content');
    }
}
