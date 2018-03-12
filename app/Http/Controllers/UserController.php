<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function get($user_id){
    	$user = User::find($user_id);
    	return view('user', ['user' => $user]);
    }
}
