<?php

namespace App\Http\Controllers\front\settings;

use App\Helper\fileUpload;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function index()
    {
        return view('front.settings.index');
    }
    public function store(Request $request)
    {
        $request->validate(['first_name' => 'required', 'last_name' => 'required', 'birthdate' => 'required', 'email' => 'required']);
        $all = $request->except('_token');
        $c = User::where('email', $all['email'])->where('id', '!=', Auth::id())->count();
        if ($c != 0) {
            return redirect()->back()->with('status', 'Bu Email Sistemde Mevcut');
        }

        $data = User::where('id', Auth::id())->get();
        $all['photo'] = fileUpload::changeUpload(Auth::id(), "user", $request->file('photo'), 0, $data, "photo");
        $update = User::where('id', Auth::id())->update($all);
        if ($update) {
            return redirect()->back()->with('status', 'Ayarlar Değiştirildi');
        } else {
            return redirect()->back()->with('status', 'Ayarlar Değiştirilemedi');
        }
    }
}
