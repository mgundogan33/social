<?php

namespace App\Http\Controllers\front\user;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index($id)
    {
        $c = User::whereId($id)->count();
        if ($c != 0) {
            $data = User::where('id', $id)->get();
            return view('front.user.index', ['data' => $data]);
        } else {
            abort(404, );
        }
    }
}
