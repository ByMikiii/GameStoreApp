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
        return $this->hasMany(Game_genre::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function owned_game(){
        return $this->belongsTo(Owned_game::class);
    }

    public function basket_item(){
        return $this->belongsTo(Basket_item::class);
    }

    public function invoice_item(){
        return $this->belongsTo(Invoice_item::class);
    }


}