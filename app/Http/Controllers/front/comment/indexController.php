<?php

namespace App\Http\Controllers\front\comment;

use App\Http\Controllers\Controller;
use App\Models\Questions;
use Illuminate\Http\Request;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['text' => 'required']);
        $id = $request->route('id');
        $c = Questions::where('id', $id)->count();
        if ($c != 0) {
            $all = $request->except('_token');
            $w = Questions::where('id', $id)->get();
            $control = Comments::where('questionId', $id)->count();
            if ($control != 0) {
                $wControl = Comments::where('questionId', $id)->orderBy('id', 'desc')->limit(1)->get();
                if ($wControl[0]['userId'] == Auth::id()) {
                    return redirect()->back()->with('status', 'Üst üste yorum yapamazsın');
                }
            }
            $all['userId'] = Auth::id();
            $all['questionId'] = $id;
            $create = Comments::create($all);

            if ($create) {
                return redirect()->back()->with('status', 'Yorum Başarı ile Eklendi');
            } else {
                return redirect()->back()->with('status', 'Yorum Eklenemedi');
            }
        } else {
            abort(404);
        }
    }
}
