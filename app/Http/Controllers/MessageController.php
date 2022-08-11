<?php

namespace App\Http\Controllers;

use App\Models\message;
use App\Models\chat;
use App\Models\User;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class MessageController extends Controller
{
    public function playmessage(Request $request){
        return message::where('chat_id',$request->chat_id)->orderBy('id', 'DESC')->get();
    }


    public function createmessage(Request $request)
    {
        message::create([
            'user_id'=>$request->user_id,
            'chat_id'=>$request->chat_id,
            'content'=>$request->content,
        ]);
    }
    public function editmessage(Request $request){
        message::where('id',$request->id)->update([
            'content'=>$request->content
        ]);
        return message::where('chat_id',$request->chat_id)->orderBy('id', 'DESC')->get();
    }
    public function deletemessage(Request $request){
        message::where('id',$request->id)->delete();
        return message::where('chat_id',$request->chat_id)->orderBy('id', 'DESC')->get();

    }

}
