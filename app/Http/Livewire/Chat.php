<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\message;
class Chat extends Component
{
    public $mess;
    public $chat_id;

    public function mount($id)
    {
        $this->chat_id = $id;
    }
     public function render()
    {
        $message=message::where('chat_id',$this->chat_id)->get();
        return view('livewire.chat' ,compact('message')  );
    }
    public function m(){
        message::create([
            'chat_id'=>$this->chat_id,
            'user_id'=>1,
            'content'=>$this->mess
        ]);
        $this->reset('mess');
    }
}
