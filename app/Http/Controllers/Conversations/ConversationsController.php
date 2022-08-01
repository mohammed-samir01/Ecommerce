<?php

namespace App\Http\Controllers\Conversations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{
    public function index(){
        return view('conversations.index');
    }
}
