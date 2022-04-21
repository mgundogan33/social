<?php

namespace App\Http\Controllers\front;

use App\Models\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use Symfony\Component\Console\Question\Question;

class indexController extends Controller
{
    public function index()
    {
        $data = Questions::orderBy('id', 'desc')->paginate(10);
        return view('front.index', ['data' => $data]);
    }
    public function view($id, $selflink)
    {
        $c = Questions::where('id', $id)->where('selflink', $selflink)->count();
        if ($c != 0) {
            $data = Questions::where('id', $id)->where('selflink', $selflink)->get();
            $comments = Comments::where('questionId', $id)->orderBy('id', 'desc')->get();
            return view('front.question.view', ['data' => $data, 'comments' => $comments]);
        } else {
            abort(404);
        }
    }
}
