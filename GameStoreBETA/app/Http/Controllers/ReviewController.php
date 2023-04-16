<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Events\NotificationSent;

class ReviewController extends Controller
{
       
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Review::create([
           'review_text' => $request->review_text,
           'positive_review' => $request->positive_review,
           'game_id' => $request->game_id,
           'user_id' => Auth::user()->id
        ]);

        Game::where("id", $request->game_id)->increment('review_count', 1);

        


        broadcast(new NotificationSent('Recenzia bola odoslaná!', Auth::user(), 'green'));
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int $game_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($game_id)
    {
        Review::where('game_id', $game_id)->where('user_id', Auth::user()->id)->delete();

        Game::where("id", $game_id)->decrement('review_count', 1);
        
        broadcast(new NotificationSent('Recenzia bola odstranená!', Auth::user(), 'green'));
    }

}
