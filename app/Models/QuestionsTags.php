<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

class QuestionsTags extends Model
{
    use HasFactory;
    protected $guarded = [];
    static function getList($questionId)
    {
        $list = QuestionsTags::where('questionId', $questionId)->get();
        return $list;
    }
}
