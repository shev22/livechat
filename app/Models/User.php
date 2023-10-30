<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
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
        'password' => 'hashed',
    ];


    public function conversations()
    {
        
        return $this->hasMany(Conversation::class,'sender_id')->orWhere('receiver_id',$this->id)->whereNotDeleted();
    }

    /**
     * The channels the user receives notification broadcasts on.
     */
    public function receivesBroadcastNotificationsOn(): string
    {
        return 'users.'.$this->id;
    }


   
    // friendship that this user started
	protected function friendsOfThisUser()
	{
		return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
		->withPivot('status')
		->wherePivot('status', 'confirmed');
	}

	// friendship that this user was asked for
	protected function thisUserFriendOf()
	{
		return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
		->withPivot('status')
		->wherePivot('status', 'confirmed');
	}


    public function pendingFriendsTo()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
		->withPivot('status')
		->wherePivot('status', 'pending');
    }

     
    public function pendingFriendsFrom()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
		->withPivot('status')
		->wherePivot('status', 'pending');
    }
     

    public function friendInstance($user)
    {
        return Friendship::where(function($q) use($user){
            $q->where(function($q) use($user) {
            $q->where('friend_id', $user['id'])
            ->where('user_id', $this->id);
            })->orWhere(function($q) use($user) {
            $q->where('friend_id', $this->id)
            ->where('user_id',  $user['id']);
            });
            })->first();
    }


    public function posts(){

     return $this ->hasMany(Post::class);
    }


 















































	// // accessor allowing you call $user->friends
	// public function getFriendsAttribute()
	// {
	// 	if ( ! array_key_exists('friends', $this->relations)) $this->loadFriends();
	// 	return $this->getRelation('friends');
	// }

	// protected function loadFriends()
	// {
	// 	if ( ! array_key_exists('friends', $this->relations))
	// 	{
	// 	$friends = $this->mergeFriends();
	// 	$this->setRelation('friends', $friends);
	// }
	// }

	// protected function mergeFriends()
	// {
	// 	if($temp = $this->friendsOfThisUser)
	// 	return $temp->merge($this->thisUserFriendOf);
	// 	else
	// 	return $this->thisUserFriendOf;
	// }


   

    // public function getFriendship(User $user) {
    // (     Friendship::where('user_id', $user->id)
    // ->where('friend_id', $this->id)
    //     ->get());
    // }     
}