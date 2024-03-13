<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Session;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login2(Request $request)
    {
        $user = User::where('phone', $request->phone)->where('status', 1)->first();
        if ($user) {
            $request['email'] = $user->email;
        } else {
            return back()->withErrors('User not found');
        }

        if ($user->user_type != 'admin') {
            $request['password'] = '123456789';
        } else {
            if ($user->status != 1) {
                return $this->sendFailedLoginResponse($request);
            }
        }

        $this->validateLogin($request);



        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }



        if ($this->attemptLogin($request)) {

            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }


            if ($user->user_type != 'admin') {
                $otp = rand(11111, 99999);
                $user->temp_phone_otp = $otp;
                $user->save();
                $sms_text = 'OTP code to login-' . $otp;
                sendSms($user->phone, $sms_text);
            }


            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    function login(Request $request)
    {
        $user = User::where('phone', $request->phone)->where('status', 1)->first();
       

        if ( $user) {
            $check_auth_user = User::where('email', $user->email)->where('status', 1)->first();
            $request['email'] = $check_auth_user->email;
    
            auth()->login($check_auth_user);
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }


            if ($user->user_type != 'admin') {
                $otp = rand(11111, 99999);
                $user->temp_phone_otp = $otp;
                $user->save();
                $sms_text = 'OTP code to login-' . $otp;
                sendSms($user->phone, $sms_text);
            }
            return $this->sendLoginResponse($request);
        } else {
            return back()->withErrors('User not found');
        }
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback(Request $request, $provider)
    {
        $user_data = [];
        $socialite_user = Socialite::driver($provider)->user();

        //check if provider_id exist
        $existingUser = User::where('email', $socialite_user->getEmail())->first();

        if ($existingUser) {
            //proceed to login
            auth()->login($existingUser, true);
        } else {
            //create a new user
            $newUser = new User;
            $newUser->name = $socialite_user->getName();
            $newUser->email = $socialite_user->getEmail();
            $newUser->password = '123456';
            $newUser->email_verified_at = date('Y-m-d Hms');
            //                $newUser->provider_id = $user->id;
            //$newUser->user_type = 'Student';
            $newUser->status = '1';
            $newUser->save();
            //proceed to login
            auth()->login($newUser, true);
        }

        if (session('temp_user_id') != null) {
            Cart::where('temp_user_id', session('temp_user_id'))
                ->update([
                    'user_id' => auth()->user()->id,
                    'temp_user_id' => null
                ]);

            Session::forget('temp_user_id');
        }

        if (session('link') != null) {
            return redirect(session('link'));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function password()
    {
        return view('auth.password');
    }


    protected function loginwithPassword(Request $request)
    {
        $user = User::where('phone', $request->phone)->where('status', 1)->first();
        if ($user) {
            $check_auth_user = User::where('email', $user->email)->where('status', 1)->first();
            $request['email'] = $check_auth_user->email;
            auth()->login($check_auth_user);
            if (auth()->user()->user_type == 'guardian') {
                return redirect()->route('my_tuition_post');
            } else if (auth()->user()->user_type == 'tutor') {
                return redirect()->route('my_tuition_post');
            }
        } else {
            return back()->withErrors('User not found');
        }
    }
}
