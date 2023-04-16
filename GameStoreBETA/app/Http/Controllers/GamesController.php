<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    
    public function getGame($game_name, $Genre, $Sort){
        if($game_name == "null"){
            $game_name = "";
        }
        if($Genre == "null"){
            $Genre = "";
        }
        if($Sort == "null"){
            $Sort = "";
        }

        $sort = "desc";
        if($Sort == "Highest price"){
            $sort_row = "original_price";
        }elseif($Sort == "Lowest price"){
            $sort_row = "original_price";
            $sort = "asc";
        }elseif($Sort == "Newest"){
            $sort_row = "release_date";
        }elseif($Sort == "Reviews"){
            $sort_row = "review_count";
        }

        $games = Game::where('name', 'ILIKE', '%'.$game_name.'%')->with('publisher')->with('game_genre')->orderBy($sort_row, $sort)->get();
        $found_games = array();

       foreach($games as $game){
        foreach($game->game_genre as $genre){
            if($genre->genre_name == $Genre){
                array_push($found_games, $game);
            }
        }
       }

       return $found_games;

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
