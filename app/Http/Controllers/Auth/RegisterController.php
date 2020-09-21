<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::check() && Auth::user()->role->id == 1 ) {
            $this->redirectTo = route('admin.dashboard');
        }elseif(Auth::check() && Auth::user()->role->id == 2){
            $this->redirectTo = route('landlord.dashboard');
        }
        else{
            $this->redirectTo = route('renter.dashboard');
        }

        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nid' => ['required', 'numeric', 'unique:users'],
            'contact' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'numeric'],
            'image' => 'mimes:jpeg,png,jpg',
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
            'role_id' => $data['role_id'],
            'name' => $data['name'],
            'username' => str_slug($data['username']),
            'email' => $data['email'],
            'nid' => $data['nid'],
            'contact' => $data['contact'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
