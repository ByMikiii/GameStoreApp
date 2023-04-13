<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $hidden = [
        
    ];

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }

    public function system_requirement(){
        return $this->hasOne(System_requirement::class);
    }

    public function game_genre(){
        return $this->belongsToMany(Genre::class, 'game_genres');
    }

    public function invoice_item(){
        return $this->belongsTo(Invoice_item::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'owned_games');
    }

    //Basket
    public function basketusers(){
        return $this->belongsToMany(Basketitems::class, 'basket_items');
    }

    //Library
    public function ownedBy(){
        return $this->belongsToMany(OwnedGame::class, 'owned_games');
    }

    //Reviews
    public function reviews(){
        return $this->hasMany(Review::class, 'game_id' );
    }



}