<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('index',[
            'users' => User::all(),
            'title' => 'xddd!'
        ]);
    }

    public function library(){
        return view('library');
    }

    public function community(){
        return view('community');
    }

    public function profile(){
        return view('profile');
    }
}