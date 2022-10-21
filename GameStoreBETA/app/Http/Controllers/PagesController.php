<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::check()){
        return view('library');
       }else {
        return redirect()->route('login');
       }
}

    public function community(){
        return view('community');
    }

    public function friends(){
        if(Auth::check()){
        return view('friends');
    }else{
        return redirect()->route('login');
    }
    }

    public function profile(){
        if(Auth::check()){
        return view('profile');
       }else {
        return redirect()->route('login');
       }
    }

        public function profileUsername($username){
        return view('username',[
            'title' => $username,
            'username' => $username
        ]);
    }

    public function chat($username){
        return view('chat',[
            'title' => 'Chat '.$username,
            'username' => $username
        ]);
    }
}