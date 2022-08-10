<?php

namespace App\Http\Controllers;

use App\Models\message;
use App\Models\chat;
use App\Models\User;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function playmessage(Request $request){
        return message::where('chat_id',$request->chat_id)->orderBy('id', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return $this->playmessage($request);
    }

    public function deletemessage(Request $request){
        message::where('id',$request->id)->delete();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(message $message)
    {
        //
    }
}
