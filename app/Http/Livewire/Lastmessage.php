<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\message;
class Lastmessage extends Component
{   public $chat_id;
    public function mount($chat_id)
    {
        $this->chat_id=$chat_id;
    }
    public function render()
    {
        $last_message =message::where('chat_id',$this->chat_id)->orderBy('id', 'desc')->first();
        return view('livewire.lastmessage',['last_message'=>$last_message]);
    }
}
