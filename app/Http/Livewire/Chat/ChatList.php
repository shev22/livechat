<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use App\Http\Livewire\traits\SearchTrait;

class ChatList extends Component
{
    use SearchTrait;
    public $selectedConversation;
    public $search;
    public $query;
    protected $listeners=['refresh'=>'$refresh'];

    public function message($id)
    {
        $this->emit('message',  $id);
       
    }


    public function findMessage($id, $conversation)
    {
        $this->emit('findMessage', $id, $conversation);
        $this->reset('search');
       
    }


   public function deleteByUser($id) {

    $userId= auth()->id();
    $conversation= Conversation::find(decrypt($id));
    $conversation->messages()->each(function($message) use($userId){

        if($message->sender_id===$userId){

            $message->update(['sender_deleted_at'=>now()]);
        }
        elseif($message->receiver_id===$userId){

            $message->update(['receiver_deleted_at'=>now()]);
        }


    } );


    $receiverAlsoDeleted =$conversation->messages()
            ->where(function ($query) use($userId){

                $query->where('sender_id',$userId)
                      ->orWhere('receiver_id',$userId);
                   
            })->where(function ($query) use($userId){

                $query->whereNull('sender_deleted_at')
                        ->orWhereNull('receiver_deleted_at');

            })->doesntExist();

    if ($receiverAlsoDeleted) {

        $conversation->forceDelete();
        # code...
    }

    return redirect(route('chat.index'));

   }


    public function trimSearch( $message ,   $search, $lenght)
    {         
        $start =  array_slice(  explode(" ", strstr( $message,$search,true)), -$lenght, $lenght);
        $end =  array_slice(  explode(" ", strstr( $message,$search)), 0, $lenght);
        $result = array_merge($start, $end);
        return (implode( " ",$result));

    }





























    public function render()
    {
        $user = auth()->user();
        return view('livewire.chat.chat-list', [
            'conversations' => $user->conversations()->latest('updated_at')->get(),
            'searchResults' => $this->searchResults($this->search)
        ]);
    }
}
