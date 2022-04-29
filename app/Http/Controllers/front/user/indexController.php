<?php

namespace App\Http\Controllers\front\user;

use App\Models\User;
use App\Models\Comments;
use App\Models\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index($id)
    {
        $c = User::whereId($id)->count();
        if ($c != 0) {
            $data = User::where('id', $id)->get();
            $questions = Questions::where('userId', $id)->orderBy('id', 'desc')->get();
            $comments = Comments::where('userId', $id)->orderBy('id', 'desc')->get();
            return view('front.user.index', ['data' => $data, 'questions' => $questions,'comments'=> $comments]);
        } else {
            abort(404,);
        }
    }
}
