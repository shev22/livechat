<?php
/**
 * Created by PhpStorm.
 * User: Francis
 * Date: 27.08.2023
 * Time: 20:11
 */
namespace App\Http\Livewire\traits;

use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

trait SearchTrait
{

    public function users($query): object
    {

       
            return (User::where('id', '!=', auth()->id())
            ->when($query, function ($e) use ($query) {
                $e
                    ->Where('email', 'like', '%' . $query . '%')
                    ->orWhere('name', 'like', '%' . $query . '%')
                    ->where('id', '!=', auth()->id());
            })
            ->paginate(10)
        );
        
       
    }


    public function searchResults($query)
    {
        $userId = Auth::id();
        if ($query) {
            $results['users'] = self::users($query);
            $messages = Message::Where('body', 'like', '%' . $query . '%')
            ->where(function ($query) use ($userId) {

                $query->where('sender_id', $userId)
                ->orWhere('receiver_id', $userId);
            })                                                  
            
            ->get();
            $results['messages'] = self::setReceiverName($messages);

            //  dd(($results));
            return $results;
        }
    }

    private static function setReceiverName(&$query)
    {
        if($query)
        {
           $ids = $query->pluck('receiver_id')->toArray();
        $users = User::whereIn('id', $ids)->get();
        foreach ($query as $value => $key) {
            foreach ($users as $user) {
                if ($key->receiver_id == $user->id) {
                    $key->receiver_name = $user->name;
                    $key->sender_name =  $key->user->name  ;
                }
               
                    
                
            }
        }  
        }
       

        return $query;
    }
}
