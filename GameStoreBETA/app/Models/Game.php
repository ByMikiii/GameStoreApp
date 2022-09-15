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
        return $this->BelongsTo(Publisher::class);
    }
}