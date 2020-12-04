<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Socialite;

class GoogleController extends Controller
{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function handleGoogleCallback()
    {

        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/home');
            } else {

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

                    'google_id' => $user->id,

                    'password' => encrypt('11223344'),

                    'role_id' => 3,

                    'nid' => uniqid(),
                    
                    'contact' => uniqid(),

                    'username' => str_slug($user->name) . uniqid(),

                ]);

                Auth::login($newUser);

                return redirect('/home');
            }
        } catch (Exception $e) {

            dd($e->getMessage());
        }
    }
}
