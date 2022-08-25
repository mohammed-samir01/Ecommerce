<?php

namespace App\Http\Livewire;
use App\Models\chat;
use App\Models\message;
use App\Models\User;
use Livewire\Component;

class ChatMessages extends Component
{
    public $chat_id;
    public $mess;
    public $user_id;
    public $user_info;
    public function mount($id)
    {
        $this->chat_id = $id;

        foreach(chat::where('id',$id)->get('user_id') as $user_id){
            $this->user_id=$user_id->user_id;
        }
        $this->user_info=User::where('id',$this->user_id)->get();


    }
    public function render()
    {
        $user_info=$this->user_info;
        $messages=message::where('chat_id',$this->chat_id)->get();
        return view('livewire.chat-messages',compact('messages','user_info'));

    }
    public function sendmessage(){
        if ($this->mess==''){

        }
        else{message::create([
            'chat_id'=>$this->chat_id,
            'user_id'=>1,
            'content'=>$this->mess
        ]);
        $this->reset('mess');}
    }
}
