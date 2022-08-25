<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\chat;
use App\Models\message;
use App\Models\user_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{

    public function playmessage(Request $request){

        $chat_id=chat::where('user_id',$request->user()->id)->first();
        $messages= message::where('chat_id',$chat_id->id)->get();
        if(count($messages) > 0 ){
            return responseJson(1,'success',['data'=>$messages]);
        }else{
            return responseJson(0,'fail',['data'=>'no messages yet']);
        }
    }


    public function createchat(Request $request){
        $exist=chat::where('user_id',$request->user()->id)->get();
        if(count($exist)>0){
            return responseJson(0,'fail',['data'=>'already has chat']);
        }else{
            $chat=chat::create([
                'user_id'=>$request->user()->id
            ]);
            return responseJson(1,'success',['data'=>$chat]);

        }

    }

    public function sendmessage(Request $request){
        $rules=[
            'content' => 'required',
        ];
        $validator =validator()->make($request->all(),$rules);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return responseJson(0,'fail',['data'=>$error]);
        }
        $chat_id=chat::where('user_id',$request->user()->id)->first();
        $message=message::create([
            'user_id'=>$request->user()->id,
            'chat_id'=>$chat_id->id,
            'content'=>$request->content,
        ]);
        return responseJson(1,'success',['data'=>$message]);
    }

    public function userStatus(Request $request)
    {
        $user = user_status::where('user_id', $request->user()->id)->get();
        if (count($user)) {
            DB::table('user_statuses')
                ->where('user_id', $request->user()->id)
                ->update(['online' => $request->online]);

            return responseJson(1, 'success', ['data' => 'user online edited']);
        } else {
            DB::table('user_statuses')->insert([
                'user_id' => $request->user()->id,
                'online' => 1,
                'typing' => 0
            ]);
            return responseJson(1, 'success', ['data' => 'user online created']);
        }
    }

    public function typing(Request $request)
    {
        DB::table('users_statuses')
            ->where('id', $request->user()->id)
            ->update(['typing' => $request->typing]);
    }




}
