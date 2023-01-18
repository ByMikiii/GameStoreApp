<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OwnedGamesController;
use App\Models\User;
use App\Models\Game;
use App\Models\Message;
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
            'game' => $game,
        ]);
        }
        else{
            return redirect()->action([PagesController::class, 'index']);
        }
    }

    public function library(){
        return view('library',[
            'title' => 'Library - Blast',
            'games' => (new OwnedGamesController)->getOwnedGames(Auth::user()->id),]);
}

    public function community(){
        if(Auth::check()){
            $friends = json_encode(Auth::user()->friends()->pluck('id')->all());
            $pendingFriendsTo = Auth::user()->pendingFriendsTo()->get();
            $pendingFriendsFrom = Auth::user()->pendingFriendsFrom()->get();
            $pFriendsTo = [];
            $pFriendsFrom = [];
            foreach ($pendingFriendsTo as $pt){
                array_push($pFriendsTo, $pt->id);
            }
            foreach ($pendingFriendsFrom as $pf){
                array_push($pFriendsFrom, $pf->id);
            }
        }else {
            $pFriendsTo = [];
            $pFriendsFrom = [];
             $friends = [];
        }
        return view('community',[
            'title' => "Community - Blast",
            'user' => User::all()->sortBy('id'),
            'friends' => $friends,
            'pendingFriendsTo' => json_encode($pFriendsTo),
            'pendingFriendsFrom' => json_encode($pFriendsFrom),
            
        ]);
    }

    public function friends(){
        $friends = json_encode(Auth::user()->friends()->all());
        return view('friends',[
            'title' => "Friends - Blast",
            'friends' => $friends
          
        ]);
    }

    public function balance(){
        return view('balance',[
            'title' => "Balance - Blast",
            'invoices' => Auth::user()->invoices()->latest('created_at')->get(),
        ]);
    }

    public function profile(){
        return view('profile',[
            'title' => Auth::user()->name." - Blast",
            'user' => Auth::user()
        ]);
    }

    public function user($username){
        $user = User::where("name", "=", $username)->get();

        if(Auth::check() && $username == Auth::user()->name){
            return redirect()->action([PagesController::class, 'profile']);
        }
        else if(!$user->isEmpty()){    
        return view('username',[
            'title' => $username." - Blast",
            'user' => $user,
        ]);
        }
        else{
            return redirect()->action([PagesController::class, 'community']);
        }
    }

    public function chat($username = null){
        $user = User::where("name", $username)->get();

        $friends = Auth::user()->friends()->sortByDesc('pivot.latest_message_at')->all();
        $final_friends = [];
        foreach($friends as $friend){
            array_push($final_friends, $friend);
        }

        if(count($user) == 0 ){
            $user = '';
        }else $user = $user[0];

        if(count($friends) == 0){
            $friends = "";
        }

        return view('chat',[
            'title' => 'Chat '.$username,
            'user' => json_encode($user),
            'friends' => json_encode($final_friends),
        ]);
        
    }

     public function any(){
        return redirect()->action([PagesController::class, 'index']);
    }

}