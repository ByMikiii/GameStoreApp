<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function index(){
        return view('index',[
            'games' => Game::all(),
            'title' => 'Market - Blast',
        ]);
    }

    public function game($gameslug){
        $game = Game::where("slug", "=", $gameslug)->get();
        
        if(!$game->isEmpty()){
            $game = $game[0];
        return view('game',[
            'title' => $game->name." - Blast",
            'game' => $game
        ]);
        }
        else{
            return redirect()->action([PagesController::class, 'index']);
        }
    }

    public function library(){
        if(Auth::check()){
        return view('library');
       }else {
        return redirect()->route('login');
       }
}

    public function community(){
        return view('community',[
            'title' => "Community - Blast",
            'users' => User::all()->sortBy('id')
        ]);
    }

    public function friends(){
        if(Auth::check()){
        return view('friends');
    }else{
        return redirect()->route('login');
    }
    }

    public function deposit(){
        if(Auth::check()){
        return view('deposit');
    }else{
        return redirect()->route('login');
    }
    }

    public function profile(){
        if(Auth::check()){
        return view('profile',[
            'title' => Auth::user()->name,
            'user' => Auth::user()
        ]);
       }else {
        return redirect()->route('login');
       }
    }

        public function user($username){
        $user = User::where("name", "=", $username)->get();

        if(Auth::check() && $username === Auth::user()->name){
            return redirect()->action([PagesController::class, 'profile']);
        }
        else if(!$user->isEmpty()){    
        return view('username',[
            'title' => $username,
            'user' => $user,
        ]);
        }
        else{
            return redirect()->action([PagesController::class, 'community']);
        }

    }

    public function chat($username){
        return view('chat',[
            'title' => 'Chat '.$username,
            'username' => $username
        ]);
    }
}