<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifications extends Model
{
    use HasFactory;
    protected $guarded=[];
    static function getIsReadCount(){
        return Notifications::where('receiverUserId',Auth::id())->where('isRead',1)->count();
    }
}
