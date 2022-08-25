<?php

namespace App\Http\Livewire;

use App\Models\message;
use Livewire\Component;

class Lastmessage extends Component
{   public $chat_id;
    public function mount($chat_id)
    {
        $this->chat_id=$chat_id;
    }
    public function render()
    {
        $last_message =message::where('chat_id',$this->chat_id)->orderBy('id', 'desc')->first();
        return view('livewire.last_message',['last_message'=>$last_message]);
    }
}
