<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owned_game extends Model
{
    use HasFactory;

    protected $table = "owned_games";

    protected $fillable = ["user_id"];

    public $timestamps = false;


}