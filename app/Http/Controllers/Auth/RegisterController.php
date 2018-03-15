<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('update');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1|confirmed',
            'cedula' => 'required|integer|unique:users',
        ]);
    }
     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorRequest(Request $data)
    {
        return $this->validate($data, [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:1|confirmed',
            'cedula' => 'required|integer',
        ]);
    }
  /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorRequest2(Request $data)
    {
        return $this->validate($data, [
            'email' => 'unique:users',
            'cedula' => 'unique:users',
        ]);

    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cedula' => $data['cedula'],
        ]);
    }


    protected function update($id, Request $data){
        $user = User::find($id);
        $this->validatorRequest($data);
        try{
            $user->nombre = $data['nombre'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->cedula = $data['cedula'];    
            $user->save();
        }catch(\Exception $e){
            // do task when error
            
            return redirect()->back()->with('error','Error al actualizar sus campos');
        }
        return redirect('/user/'.$id)->with('message','Usuario Actualizado Exitosamente');
    }
}
