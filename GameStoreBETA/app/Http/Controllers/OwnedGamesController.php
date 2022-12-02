<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;

class OwnedGamesController extends Controller
{
    // To get all games of a user
     public function getOwnedGames($user_id)
    {
        return User::find($user_id)->games;
    }

    // To get all users by game
    public function getUsers($game_id)
    {
        return Game::find($game_id)->users;
    }
}