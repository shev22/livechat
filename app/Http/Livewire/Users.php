<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\traits\SearchTrait;
use App\Http\Livewire\traits\FriendsTrait;


class Users extends Component
{
    use WithPagination;
    use FriendsTrait;
    use SearchTrait;

    public $test = false;
    public $search;
   

    public function message($id)
    {
        $this->emit('message',  $id);
    }


    public function addTofriends($id)
    {

        $this->addTofriends($id);
        // $this->emit('addTofriends',  $id);
    }

    public function unFriend($friend)
    {
       $this->unFriend($friend);
    }

    public function getFriendInstance($user)
    {
      return (auth()->user()->friendInstance($user)); ;
    }

    public function render()
    {
 
        return view('livewire.users', [
            'users' =>  $this->users($this->search),
            // 'friendRequests'=> auth()->user()->friendRequests()->get()
        ]);
    }
    
}
