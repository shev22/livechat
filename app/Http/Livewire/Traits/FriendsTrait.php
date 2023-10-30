<?php

/**
 * Created by PhpStorm.
 * User: Francis
 * Date: 09.09.2023
 * Time: 15:11
 */

namespace App\Http\Livewire\traits;

use App\Models\User;
use App\Models\Message;
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

trait FriendsTrait
{


	public function unFriend($friend)
	{

		auth()->user()->friendInstance($friend)->delete();
	}


	public function rejectFriendRequest($friend)
	{
		// dd($friend);
		auth()->user()->friendInstance($friend)->delete();
	}

	public  function acceptFriendRequest($friend)
	{
		auth()->user()->friendInstance($friend)->update(['status' => 'confirmed']);
	}

	public  function addTofriends($user)
	{
		
		$friend = auth()->user()->friendInstance($user);

		if (!$friend) {
			Friendship::create([
				'user_id' => Auth::id(),
				'friend_id' => $user['id'],
				'acted_user' => Auth::id(),
				'status' => 'pending'
			]);
		}
	}
}
