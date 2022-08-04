<?php

namespace App\Http\Livewire\Conversations;
use Illuminate\Support\Collection;
use Livewire\Component;

class ConversationList extends Component
{
    public $conversations;
    public function mount(collection $conversations){
        $this->conversations=$conversations;
    }
    public function render()
    {
        return view('livewire.conversations.conversation-list');
    }
}
