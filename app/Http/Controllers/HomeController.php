<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Message;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
       $friends = DB::table('friends')->select('friend_id')->where('user_id', $user->id)->get();
         
        $aux =[];
          foreach ($friends as $key => $value) {
            $aux[$key]= $value->friend_id;
          }
        array_push($aux,$user->id );
        $messages = Message::whereIn('user_id', $aux)->latest()->get();
     
        return view('home', ['messages' => $messages]);
    }
}
