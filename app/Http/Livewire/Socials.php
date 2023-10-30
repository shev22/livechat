<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\traits\FriendsTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;


class Socials extends Component
{
    use WithFileUploads;
    use WithPagination;
    use FriendsTrait;

    public $title, $description, $photo;
    protected $rules = [
        'title' => 'required|min:6',
        'description' => 'required',
         'photo' => 'image|max:1024'
    ];
 
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


        // FRIENDSHIP

    public function friends()
    {
        $incoming = auth()->user()->friendsOfThisUser;
        $outgoing = auth()->user()->thisUserFriendOf;
      return $merged = $outgoing->merge($incoming);
       
    }

    public function unFriend($user)
    {

      $this->unFriend($user);
    }

    public function rejectFriendRequest($user)
    {
      $this->rejectFriendRequest($user);
    }

    public function acceptFriendRequest($user)
    {
      $this->acceptFriendRequest($user);
    }


        // BLOG

    public function storePost()
    {
      
        $validatedData = $this->validate();
        $newImageName = uniqid() . '-' . $this->title . '.' . $this->photo->extension();
        $this->photo->storeAs('public/photos', $newImageName);
   
        Post::create([
            'slug' => SlugService::createSlug(Post::class, 'slug', $this->title),
            'title' => $this->title,
            'description' => $this->description,
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id
        ]);



    }
        




    public function message($id)
    {
        $this->emit('message',  $id);
    }


    public function render()
    {
       
        return view(
            'livewire.socials',
            [

                'posts'=> Post::orderBy('updated_at', 'DESC')->get(),
                'friends' => $this->friends(),
                'pendingOutgoingRequests' => auth()->user()->pendingFriendsTo,
                'pendingIncomingRequests' => auth()->user()->pendingFriendsFrom

            ]
        );
    }
}
