<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalMessage extends Model
{
    use HasFactory;

    protected $fillable = ['message_text'];
    //USER
    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
