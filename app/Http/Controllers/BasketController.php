<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Basket_item;
use App\Models\OwnedGame;
use Illuminate\Http\Request;
use App\Events\NotificationSent;


class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Auth::user()->basketitems()->get()->count();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $game_id
     * @return \Illuminate\Http\Response
     */
    public function store($game_id)
    {
        $alreadyInBasket = Basket_item::where('game_id', $game_id)->where('user_id', Auth::user()->id)->get();
        $alreadyOwned = OwnedGame::where('game_id', $game_id)->where('user_id', Auth::user()->id)->get();

        if(!$alreadyInBasket->isempty()){
            broadcast(new NotificationSent('Túto položku už v košíku máte!', Auth::user(), 'red'));
        }
        else if(!$alreadyOwned->isempty()){
            broadcast(new NotificationSent('Túto položku už vlastníte!', Auth::user(), 'red'));
        }
        else{
            Basket_item::create([
                'user_id' => Auth::user()->id,
                'game_id' => $game_id]);
            broadcast(new NotificationSent('Položka bola pridaná do košíka!', Auth::user(), 'green'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $game_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($game_id)
    {
        Basket_item::where(['game_id' => $game_id])->delete();
        //broadcast(new NotificationSent('Item was removed from basket!', Auth::user(), 'green'));
    }
}
