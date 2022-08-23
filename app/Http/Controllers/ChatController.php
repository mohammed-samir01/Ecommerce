<?php

namespace App\Http\Controllers;

use App\Models\chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{

   /*  public function displaychat(Request $request){
        return chat::where('user_id',$request->user_id)->get();
    } */
    public function adminrender(){
      $chats=chat::join('users','users.id','=','chats.user_id')
        ->get(['chats.*','users.first_name','users.user_image']);
          return  view('chattheme',compact('chats')) ; 

    }
    public function getmessages($id){
        $chats=chat::join('users','users.id','=','chats.user_id')
            ->get(['chats.*','users.first_name','users.user_image']);
        return  view('chattheme',compact('chats','id')) ;
    }

  /*   public function createchat(Request $request){
          chat::create([
                'user_id'=>$request->user_id
            ]);
            return chat::where('user_id',$request->user_id)->get();
    } */


}
