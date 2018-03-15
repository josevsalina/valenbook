<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function create(Request $request){
    	$this->validate($request, [
    		'message' => 'required',
    	]);

    	$user = $request->user();
 
    	$message = Message::create([
    		'content' =>  $request->input('message'),
    		'user_id' => $user->id,
    	]);

    	return redirect('/');
    }

    public function delete($message_id){
        Message::destroy($message_id);
        return redirect()->back()->with('message', 'Mensaje borrado exitosamente');
    }

    public function updateView($user_id, $message_id, Request $request){
        $message = Message::find($message_id);
        return view('message', ['message' => $message]);
    }

    public function update($message_id, Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);
        $message = Message::find($message_id);
        $message->content = $request['content'];
        $message->save();

        return redirect('/')->with('message','Actualizado Exitosamente');
    }
}
