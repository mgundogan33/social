<?php

namespace App\Http\Controllers\front;

use App\Models\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Question\Question;

class indexController extends Controller
{
    public function index()
    {
        $data=Questions::orderBy('id','desc')->paginate(10);
        return view('front.index',['data'=>$data]);
    }
}
