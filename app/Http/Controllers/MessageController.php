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
}
