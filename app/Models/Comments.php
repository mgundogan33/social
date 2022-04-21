<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $guarded = [];
    static function getCount($questionId)
    {
        return Comments::where('questionId',$questionId)->count();
    }
}
