<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\chat;

class Showchats extends Component
{

    public $search;
    protected $queryString = ['search'];
    public function render()
    {   $chats=chat::join('users','users.id','=','chats.user_id')->
        where('users.first_name', 'like', '%' . $this->search . '%')
        ->get(['chats.*','users.first_name','users.user_image']);
         return  view('livewire.showchats',['chats'=>$chats]) ;
    }
}
