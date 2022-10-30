<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    public function basket_item(){
        return $this->hasMany(Basket_item::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}