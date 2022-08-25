<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\chat;

class ChatController extends Controller
{


    public function adminrender(){
      $chats=chat::join('users','users.id','=','chats.user_id')
        ->get(['chats.*','users.first_name','users.last_name','users.user_image']);
          return  view('layouts.chat_theme',compact('chats')) ;

    }

    public function getmessages($id){
        $chats=chat::join('users','users.id','=','chats.user_id')
            ->get(['chats.*','users.first_name','users.user_image']);
        return  view('layouts.chat_theme',compact('chats','id')) ;
    }




}
