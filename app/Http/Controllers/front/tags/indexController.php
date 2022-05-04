<?php

namespace App\Http\Controllers\front\tags;

use App\Http\Controllers\Controller;
use App\Models\QuestionsTags;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        $data = QuestionsTags::groupBy('name')->paginate(20);
        return view('front.tags.index', ['data' => $data]);
    }
}
