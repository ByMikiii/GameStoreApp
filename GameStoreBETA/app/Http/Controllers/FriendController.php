<?php

namespace App\Http\Controllers;

use App\Models\Friend;
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

        return response()->json([
            'message' => 'Request sent',
        ]);

        }else{
            return response()->json([
             'message' => 'Add Friend',
         ]); 
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}