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

    public function updateUser()
    {
    	return view('user.update');
    }

     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function update(array $data)
    {
         $this->validate($data, [
            'nombre' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'string|min:1|confirmed',
            'cedula' => 'integer|unique:users',
        ]);
         dd($data);
    }
}
