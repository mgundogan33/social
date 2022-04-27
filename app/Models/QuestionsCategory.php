<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    static function getCount($categoryId)
    {
        return QuestionsCategory::where('category', $categoryId)->count();
    }

    static function isChecked($category, $questionId)
    {
        $c = QuestionsCategory::where('category', $category)->where('questionId', $questionId)->count();
        if ($c != 0) {
            return true;
        } else {
            return false;
        }
    }
}
