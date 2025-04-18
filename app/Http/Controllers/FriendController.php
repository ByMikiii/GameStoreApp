<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NotificationSent;


class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFriends()
    {
        return Auth::user()->friends()->pluck('id')->all();
    }

    public function getPendingFriendsTo()
    {
        $pendingFriendsTo = Auth::user()->pendingFriendsTo()->get();
        $pFriendsTo = [];
            
        foreach ($pendingFriendsTo as $pt){
            array_push($pFriendsTo, $pt->id);
        }

        return json_encode($pFriendsTo);
            
    }

    public function getPendingFriendsFrom()
    {
        $pendingFriendsFrom = Auth::user()->pendingFriendsFrom()->get();
        $pFriendsFrom = [];

        foreach ($pendingFriendsFrom as $pf){
                array_push($pFriendsFrom, $pf->id);
            }
        
            return json_encode($pFriendsFrom);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($friend_id)
    {
        $already_exists = Friend::where("user_id", "=", Auth::user()->id)->where("friend_id", "=", $friend_id)->get();
        if($already_exists->isEmpty()){
            $already_exists = Friend::where("friend_id", "=", Auth::user()->id)->where("user_id", "=", $friend_id)->get();
        }

        if($already_exists->isEmpty()){
        $friend = new Friend();
        $friend->user_id = Auth::user()->id;
        $friend->friend_id = $friend_id;
        $friend->save();

        $friend = User::where("id", $friend_id)->get()[0];

        broadcast(new NotificationSent( Auth::user()->name.' vám poslal žiadosť o priateľstvo!', $friend, 'green'));

        broadcast(new NotificationSent( 'Žiadosť o priateľstvo bola odoslaná!', Auth::user(), 'green'));

        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function update($friend_id)
    {
        Friend::where("user_id", "=", $friend_id)->where("friend_id", "=", Auth::user()->id)->update(['isAccepted' => 1]);

        broadcast(new NotificationSent('Žiadosť o priateľstvo bola prijatá!', Auth::user(), 'green'));
    }

    public function destroy($friend_id)
    {
       Friend::where("user_id", "=", Auth::user()->id)->where("friend_id", "=", $friend_id)->delete();
       Friend::where("user_id", "=", $friend_id)->where("friend_id", "=", Auth::user()->id)->delete();

        //broadcast(new NotificationSent('Friend successfully removed!', Auth::user(), 'green'));

    }
}