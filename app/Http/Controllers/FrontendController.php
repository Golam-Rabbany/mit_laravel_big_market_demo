<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class FrontendController extends Controller
{
    //

    public function frontpage(){

        $alldata = Category::with('product')->get();
        return view('frontend.frontpage',compact('alldata'));
    }
}
