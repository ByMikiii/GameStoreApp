<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Game;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }

    public function friendsTo(){
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('isAccepted');
    }
 
    public function friendsFrom(){
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
            ->withPivot('isAccepted');
    }

    public function pendingFriendsTo(){
        return $this->friendsTo()->wherePivot('isAccepted', false);
    }
    
    public function pendingFriendsFrom(){
        return $this->friendsFrom()->wherePivot('isAccepted', false);
    }
    
    public function acceptedFriendsTo(){
        return $this->friendsTo()->wherePivot('isAccepted', true);
    }
    
    public function acceptedFriendsFrom(){
        return $this->friendsFrom()->wherePivot('isAccepted', true);
    }

    public function friends()
    {
        return $this->acceptedFriendsTo->merge($this->acceptedFriendsFrom);
    }



    public function message(){
        return $this->hasMany(Message::class);
    }
    
    public function games(){
        return $this->belongsToMany(Game::class, 'owned_games');
    }

    

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'email',
        'full_name',
        'wallet',
        'address',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}