<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket_item extends Model
{
    use HasFactory;

    public function basket(){
        return $this->belongsTo(Basket::class);
    }

    public function game(){
        return $this->hasOne(Game::class);
    }
}