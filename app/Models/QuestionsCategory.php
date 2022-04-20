<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsCategory extends Model
{
    use HasFactory;
    protected $guarded=[];

    static function getCount($categoryId){
        return QuestionsCategory::where('category',$categoryId)->count();
    }

}
