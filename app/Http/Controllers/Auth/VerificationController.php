<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;


class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
            $user = User::find($request->route('id'));

            auth()->login($user);

            if ($request->user()->hasVerifiedEmail()) {
                return redirect($this->redirectPath());
            }

            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }

            if(Auth::check() && Auth::user()->role->id ==1 ){
                $this->redirectTo = route('admin.dashboard');
            }
            if(Auth::check() && Auth::user()->role->id ==2 ){
                $this->redirectTo = route('landlord.dashboard');
            }
            if(Auth::check() && Auth::user()->role->id ==3 ){
                $this->redirectTo = route('renter.dashboard');
            }

            return redirect($this->redirectPath())->with('verified', true);
    }

}
