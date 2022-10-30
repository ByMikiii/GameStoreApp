<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invioce_item extends Model
{
    use HasFactory;

        public function game(){
        return $this->hasOne(Game::class);
    }

        public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}