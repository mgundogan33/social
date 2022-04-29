<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $guarded = [];

    static function getSelflink($questionId)
    {
        $data = Questions::where('id', $questionId)->get();
        return $data[0]['selflink'];
    }
}
