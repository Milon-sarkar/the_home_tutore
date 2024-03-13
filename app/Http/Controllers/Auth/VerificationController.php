<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['check_phone_number', 'check_email']);
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function check_phone_number(Request $request){
        $request->validate([
            'phone' => 'required'
        ]);

        if($request->avoid_already == 'true'){
            $user = User::where('id','!=', auth()->id())->where('phone', $request->phone)->first();
            if($user != null){
                return response()->json(['result' => false]);
            }
        }else{
            $user = User::where('phone', $request->phone)->first();

            if($user != null){
                return response()->json(['result' => false]);
            }
        }

    }

    public function check_email(Request $request){
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $user = User::where('email', $request->email)->first();

        if($user != null){
            return response()->json(['result' => false]);
        }
    }

}
