<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Tutor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PhoneVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function insert_phone_save(Request $request){
        $request->validate([
            'phone' => ['required', 'numeric', 'digits:11', 'unique:users'],
        ]);

        $user = Auth::user();
        $user->phone = $request->phone;
        $user->save();
        return back()->withSuccess('Please verify your phone number');
    }

    public function phone_otp_resend(Request $request){
        $time = Carbon::now()->addMinutes(10);
        $time = date_format(date_create($time),'Y-m-d h:i:s');
        if(auth()->check()){
            $otp = rand(11111,99999);
            $user = auth()->user();
            $user->temp_phone_otp = $otp;
//            $user->phone_otp = $otp;
            $user->phone_otp_expired_at = $time;
            $user->save();
        }

        $str = 'OTP code to login-'. $user->temp_phone_otp;

        sendSms($user->phone, $str);

        Session::put('phone_otp_resent', true);

        return back();

    }

    public function phone_otp_verify(Request $request){
        $time = Carbon::now();
        $time = date_format(date_create($time),'Y-m-d h:i:s');

        $request->validate([
            'phone_otp' => 'required|digits:5|numeric'
        ]);

        $user = User::where('phone', auth()->user()['phone'])->where('temp_phone_otp', $request->phone_otp)->where('id', auth()->user()['id'])->first();

        if($user){
            $user->temp_phone_otp = null;
            $user->phone_verified_at = $time;
            $user->save();

            Session::put('msg', 'Successfully login');
            return back()->withSuccess('Phone Number Verified');
        }else{
            Session::put('msg', 'Login Failed');
            return back()->withErrors('Invalid OTP');
        }


    }
}
