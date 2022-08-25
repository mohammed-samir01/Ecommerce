<?php

namespace App\Http\Livewire;

use App\Models\chat;
use Livewire\Component;

class Showchats extends Component
{

    public $search;
    protected $queryString = ['search'];
    public function render()
    {
        $chats=chat::join('users','users.id','=','chats.user_id')->
        where('users.first_name', 'like',  $this->search . '%')
        ->get(['chats.*','users.first_name','users.last_name','users.user_image']);
         return  view('livewire.showchats',['chats'=>$chats]) ;
    }
}
