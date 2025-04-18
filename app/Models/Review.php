<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_text',
        'user_id',
        'game_id',
        'positive_review',
    ];
    

     public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

     public function game(){
        return $this->belongsTo(Game::class, 'game_id');
    }
}