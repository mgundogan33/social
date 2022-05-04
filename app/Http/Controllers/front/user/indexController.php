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
            $data = User::find($id);
            $questions = Questions::where('userId', $id)->orderBy('id', 'desc')->get();
            $comments = Comments::where('userId', $id)->orderBy('id', 'desc')->get();
            return view('front.user.index', compact('data', 'questions', 'comments'));
        } else {
            abort(404);
        }
    }
    public function all()
    {
        $data = User::orderBy('id', 'desc')->paginate(10);
        return view('front.user.all', ['data' => $data]);
    }
}
