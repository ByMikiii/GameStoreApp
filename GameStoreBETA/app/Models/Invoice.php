<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

     public function invoice_item(){
        return $this->hasMany(Invoice_item::class);
    }

     public function user(){
        return $this->belongsTo(User::class);
    }
}