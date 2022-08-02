<?php

namespace App\Http\Controllers\Conversations;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{
    public function index(){
        $conversations=Conversation::get();
        return view('conversations.index',compact('conversations'));
    }
}
