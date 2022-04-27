<?php

namespace App\Http\Controllers\front\question;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Questions;
use App\Models\QuestionsCategory;
use App\Models\QuestionsTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Question\Question;

class indexController extends Controller
{
    public function create()
    {
        $category = Category::all();
        return view('front.question.create', ['category' => $category]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'category' => 'required',
            'tags' => 'required'
        ]);
        $all = $request->except('_token');

        $category = $all['category'];
        unset($all['category']);

        $tags = explode(',', $all['tags']);
        unset($all['tags']);

        $all['userId'] = Auth::id();

        $all['selflink'] = Helpers::permalink($all['text']);
        //dd($all);

        $create = Questions::create($all);
        if ($create) {
            foreach ($category as $key => $v) {
                QuestionsCategory::create(['questionId' => $create->id, 'category' => $v]);
            }
            foreach ($tags as $k => $v) {
                QuestionsTags::create(['name' => $v, 'selflink' => Helpers::permalink($v), 'questionId' => $create->id]);
            }
            return redirect()->back()->with('status', 'Soru Başarı ile Soruldu :)');
        } else {
            return redirect()->back()->with('status', 'Soru Sorulamadı :/');
        }
    }
    public function edit($id)
    {
        $c = Questions::where('id', $id)->where('userId', Auth::id())->count();
        if ($c != 0) {
            $category = Category::all();
            $data = Questions::where('id', $id)->where('userId', Auth::id())->get();
            return view('front.question.edit', ['data' => $data, 'category' => $category]);
        } else {
            abort(404);
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Questions::where('id', $id)->where('userId', Auth::id())->count();
        if ($c != 0) {
            $request->validate([
                'title' => 'required',
                'text' => 'required',
                'category' => 'required',
                'tags' => 'required'
            ]);
            $all = $request->except('_token');
            $category = $all['category'];
            unset($all['category']);

            $tags = $all['tags'];
            unset($all['tags']);

            QuestionsCategory::where('questionId', $id)->delete();
            foreach ($category as $k => $v) {
                QuestionsCategory::create(['questionId' => $id, 'category' => $v]);
            }
            $tagsExplode = explode(',', $tags);
            QuestionsTags::where('questionId', $id)->delete();
            foreach ($tagsExplode as $k => $v) {
                QuestionsTags::create(['questionId' => $id, 'name' => $v, 'selflink' => Helpers::permalink($v)]);
            }

            $all['selflink'] = Helpers::permalink($all['title']);

            Questions::where('id', $id)->update($all);
            return redirect()->back()->with('status', 'Bilgiler Değiştirildi');
        } else {
            abort(404);
        }
    }
}
