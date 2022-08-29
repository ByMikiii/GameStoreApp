<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return Game::all();
        return view('index');
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