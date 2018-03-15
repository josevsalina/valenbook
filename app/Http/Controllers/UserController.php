<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
class UserController extends Controller
{
    public function get($user_id){
    	$user = User::find($user_id);
    	return view('user', ['user' => $user]);
    }

    public function friends_as($user_id){
    	$user = User::find($user_id);
    	return view('friends', [
    		'user' => $user,
    	]);
    }
    public function friends($user_id){
    	$user = User::find($user_id);
    	return view('friends', [
    		'user' => $user,
    	]);
    }
    public function addFriend($user_id, Request $request){
    	$user = User::find($user_id);

    	$me = $request->user();
    	$user->friends()->attach($me);
    	$me->friends()->attach($user);
    	return redirect('/user/'.$user_id)->withSuccess('Usuario agregado');
    }
	public function deleteFriend($user_id, Request $request){
    	$user = User::find($user_id);
    	$me = $request->user();
    	$user->friends()->detach($me);
    	$me->friends()->detach($user);
    	return redirect()->back()->withSuccess('Usuario Eliminado');
    }

    public function updateView()
    {
    	return view('user.update');
    }

}
