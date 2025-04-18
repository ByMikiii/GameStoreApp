<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_item extends Model
{
    protected $fillable = [
        'game_id', 'quantity', 'invoice_id'
    ];

    use HasFactory;

        public function game(){
        return $this->hasOne(Game::class);
    }

        public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}