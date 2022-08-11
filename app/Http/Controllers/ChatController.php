<?php

namespace App\Http\Controllers;

use App\Models\chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function displaychat(Request $request){
        return chat::where('user_id',$request->user_id)->get();
    }

    public function createchat(Request $request){
          chat::create([
                'user_id'=>$request->user_id
            ]);
            return chat::where('user_id',$request->user_id)->get();
    }


}
