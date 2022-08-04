<?php

namespace App\Http\Controllers\Conversations;

use App\Http\Controllers\Controller;
use App\Models\conversation;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{
    public function index(Request $request){
        $conversations=$request->user()->conversation;
        return view('conversations.index',compact('conversations'));
    }
}
