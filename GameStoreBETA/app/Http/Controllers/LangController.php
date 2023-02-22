<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App;
use App\Http\Controllers\PagesController;

class LangController extends Controller
{
    public function index($lang)
    {
        return response()->json($lang);
    }

    public function changelang($lang)
    {
        if(Auth::check()){
            User::where('id', Auth::user()->id)->update(['locale' => $lang]);
        }

        App::setLocale('en');

        return redirect('/');
    }
}
