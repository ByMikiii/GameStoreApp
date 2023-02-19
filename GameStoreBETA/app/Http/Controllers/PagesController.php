<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OwnedGamesController;
use App\Models\User;
use App\Models\Game;
use App\Models\Review;
use App\Models\Basket_item;
use App\Models\Message;
use App\Models\OwnedGame;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function index(){
        $newGames = Game::orderBy('created_at', 'desc')->get()->slice(0, 4);
        $saleGames = Game::where('is_sale', 1)->orderBy('original_price', 'desc')->get();
        return view('index',[
            'games' => Game::orderBy('name', 'asc')->get(),
            'newGames' => $newGames,
            'saleGames' => $saleGames,
            'title' => 'Market - Blast',
            
        ]);
    }

    public function game($gameslug){
        $game = Game::where("slug", "=", $gameslug)->get();
        
        if(!$game->isEmpty()){
            $game = $game[0];
            $reviews = Review::where('game_id', $game->id)->with('user')->orderBy('id', 'desc')->get();

        $owngame = Auth::user()?->ownedGames()->where('game_id', $game->id)->get();
        if($owngame == null) { $owngame = 0;}
        else if($owngame != "[]"){
            $owngame = 1;
        }else { $owngame = 0;}

        return view('game',[
            'title' => $game->name." - Blast",
            'game' => $game,
            'reviews' => $reviews,
            'owngame' => $owngame,
        ]);
        }
        else{
            return redirect()->action([PagesController::class, 'index']);
        }
    }

    public function library(){
        return view('library',[
            'title' => 'Library - Blast',
            'games' => Auth::user()->ownedGames()->with('reviews')->get(),
            ]);
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
            'friends' => $friends,
          
        ]);
    }

    public function balance(){
        return view('balance',[
            'title' => "Balance - Blast",
            'invoices' => Auth::user()->invoices()->latest('created_at')->get(),
        ]);
    }

    public function profile(){
         $reviews = Review::where('user_id', Auth::user()->id)->with('user')->with('game')->orderBy('id','desc')->get();
        return view('profile',[
            'title' => Auth::user()->name." - Blast",
            'user' => Auth::user(),
            'reviews' => $reviews,
        ]);
    }

    public function user($username){
        $user = User::where("name", "=", $username)->get();
        $reviews = Review::where('user_id', $user[0]->id)->with('user')->with('game')->orderBy('id','desc')->get();
        if(Auth::check() && $username == Auth::user()->name){
            return redirect()->action([PagesController::class, 'profile']);
        }
        else if(!$user->isEmpty()){  
            $friends = json_encode(Auth::user()?->friends()->pluck('id')->all());
            $pendingFriendsTo = Auth::user()?->pendingFriendsTo()->get();
            $pendingFriendsFrom = Auth::user()?->pendingFriendsFrom()->get();
            $pFriendsTo = [];
            $pFriendsFrom = [];

            if(!empty($pendingFriendsTo)){
                foreach ($pendingFriendsTo as $pt){
                    array_push($pFriendsTo, $pt->id);
                }
            }

            if(!empty($pendingFriendsFrom)){
                foreach ($pendingFriendsFrom as $pf){
                    array_push($pFriendsFrom, $pf->id);
                }   
            }
         return view('profile',[
            'title' => $user[0]->name." - Blast",
            'user' => $user[0],
            'friends' => $friends,
            'pendingFriendsTo' => json_encode($pFriendsTo),
            'pendingFriendsFrom' => json_encode($pFriendsFrom),
            'reviews' => $reviews
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
    public function basket(){
        $basketitems = Auth::user()->basketitems()->get();
        $totalprice = 0;
        foreach($basketitems as $basketitem){
            if($basketitem->is_sale == 1){
                $totalprice += $basketitem->sale_price;
            }else{$totalprice += $basketitem->original_price;}  
        }
        
        return view('basket', [
            'title' => 'Basket - Blast',
            'basketitems' => $basketitems,
            'totalprice' => $totalprice
        ]);
    }

    
     public function any(){
        return redirect()->action([PagesController::class, 'index']);
    }

}