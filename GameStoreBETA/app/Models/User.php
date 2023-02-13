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

    //COUNTRIES
    public function country(){
        return $this->belongsTo(Country::class);
    }

    //INVOICES
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    //FRIENDS
    public function friendsTo(){
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('isAccepted')->withPivot('latest_message_at')->withPivot('latest_message_text');
    }
 
    public function friendsFrom(){
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
            ->withPivot('isAccepted')->withPivot('latest_message_at')->withPivot('latest_message_text');
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

    //MESSAGES
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    //GLOBAL MESSAGES
    public function globalMessages()
    {
        return $this->hasMany(GlobalMessage::class, 'sender_id');
    }

    //BASKET
    public function basketitems(){
        return $this->belongsToMany(Game::class, 'basket_items');
    }

    //LIBRARY
    public function ownedGames(){
        return $this->belongsToMany(Game::class, 'owned_games');
    }

    //REVIEWS
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
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