<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index(){
        return view('index',[
            'games' => Game::all(),
            'title' => 'Store',
        ]);
    }

    public function game($game){
        return view('game',[
            'game' => $game,
            'games' => Game::where("slug", "=", $game)->get()
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

        public function profileUsername($username){
        return view('username',[
            'title' => $username,
            'username' => $username
        ]);
    }
}