<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    public function destroy($friend_id)
    {
       Friend::where("user_id", "=", Auth::user()->id)->where("friend_id", "=", $friend_id)->delete();
       Friend::where("user_id", "=", $friend_id)->where("friend_id", "=", Auth::user()->id)->delete();
    }
}