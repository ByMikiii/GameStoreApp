<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Events\MessagePosted;
use App\Events\NotificationSent;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $messages1 = Message::where('sender_id', Auth::user()->id)->where('receiver_id', $id)->with('sender')->with('receiver')->get();
        $messages2 = Message::where('sender_id', $id)->where('receiver_id', Auth::user()->id)->with('sender')->with('receiver')->get();

        $messages = array_merge($messages1->toArray(), $messages2->toArray());

        usort($messages, function($a, $b){
            return $a['created_at'] <=> $b['created_at'];
        });
        return $messages;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth = Auth::user();

        $message = Auth::user()->messages()->create([
           'text' => $request->text,
           'receiver_id' => $request->receiver_id,
        ]);

        $receiver = User::where('id',$request->receiver_id)->get();

        broadcast(new MessagePosted($message, $receiver[0], $auth))->toOthers();

        broadcast(new NotificationSent( Auth::user()->name.' sent you a message!', $receiver[0], 'blue'));



        DB::table('friends')->where('user_id', $request->receiver_id)->where('friend_id', Auth::user()->id)->update(['latest_message_at'=>now('cet')]);
        DB::table('friends')->where('user_id', Auth::user()->id)->where('friend_id', $request->receiver_id)->update(['latest_message_at'=>now('cet')]);

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
