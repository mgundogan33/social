<?php

namespace App\Http\Controllers\front\question;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function create()
    {
        $category=Category::all();
        return view('front.question.create',['category'=>$category]);
    }
}
