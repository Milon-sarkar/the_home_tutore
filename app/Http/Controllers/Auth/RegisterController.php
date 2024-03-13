<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Tutor;
use App\Traits\FileCustomizeTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
         //dd($request->all());

        $this->validator($request->all())->validate();

        if ($request['user_type'] == 'tutor') {
            $this->tutor_validator($request->all())->validate();
        }

        event(new Registered($user = $this->create($request->all())));

        $otp = rand(11111, 99999);
        $user->temp_phone_otp = $otp;
        $user->save();

        $sms_text = 'OTP code to register-' . $otp;

        sendSms($user->phone, $sms_text);

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
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
            'user_type' => ['required', 'string', 'max:255', Rule::in(['guardian', 'student', 'tutor'])],
            'phone' => ['required', 'numeric', 'digits:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function tutor_validator(array $data)
    {
        return Validator::make($data, [
            'whatsapp' => ['required'],
            'gender' => ['required'],
            'district_id' => ['required'],
            'thana_id' => ['required'],
            //            'area_id' => ['required'],
            'interest_class' => ['required'],
            'interest_sub' => ['required'],
            'interest_medium' => ['required'],
            //            'preferred_area_id' => ['required'],
            //            'image' => ['mimes:jpg,jpeg,png', 'max: 1024'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if (!isset($data['email']) or $data['email'] == '') {
            $data['email'] = $data['phone'] . "@mail.com";
        }

        if ($data['user_type'] == 'tutor') {
            //   dd($data);
            $user = new User();

            $user->name = $data['name'];
            $user->user_type = $data['user_type'];
            $user->email = $data['email'];
            $user->email_verified_at = Carbon::now();
            $user->phone = $data['phone'];
            $user->phone_verified_at = Carbon::now();
            $user->password = Hash::make($data['password']);
            $user->pwd = $data['password'];
            $user->is_change_pass = 1;
            $user->whatsapp = $data['whatsapp'];
            $user->status = 1;

            //            if($data->hasFile('image')){
            //                FileCustomizeTrait::deleteFile($data->avatar);
            //                $file = $data->file('image') ;
            //                $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
            //                $destinationPath = public_path().'/storages/tutor/' ;
            //                $file->move($destinationPath,$fileName);
            //                $user->avatar = '/storages/tutor/'.$fileName;
            //            }


            $user->save();

            $area = Area::where('name', $data['area_name'])->where('district_id', $data['district_id'])->where('thana_id', $data['thana_id'])->first();
            if ($area == null) {
                $area = new Area();
                $area->district_id = $data['district_id'];
                $area->thana_id = $data['thana_id'];
                $area->name = $data['area_name'];
                $area->save();
            }

            $preferred_area_id = [];

            if ($data['preferred_area_id']) {
                foreach ($data['preferred_area_id'] as $preferred_area) {
                    $area = Area::where('name', $preferred_area)->where('district_id', $data['district_id'])->where('thana_id', $data['thana_id'])->first();
                    if ($area == null) {
                        $area = new Area();
                        $area->district_id = $data['district_id'];
                        $area->thana_id = $data['thana_id'];
                        $area->name = $preferred_area;
                        $area->save();
                    }
                    array_push($preferred_area_id, $area->id);
                }
            }

            $preferred_area_id = array_unique($preferred_area_id);


            $tutors = Tutor::count();
            $tutor_code = $tutors + 1;
            $tutor = new Tutor;
            $tutor->user_id = $user->id;
            $tutor->tutor_code = $tutor_code;
            $tutor->gender = $data['gender'];
            $tutor->permanent_district_id = $data['permanent_district_id'];
            $tutor->district_id = $data['district_id'];
            $tutor->thana_id = $data['thana_id'] ?? '';
            $tutor->area_id = $area->id;
            $tutor->interest_class = $data['interest_class'] ?? '';
            $tutor->interest_sub = $data['interest_sub'] ?? '';
            $tutor->interest_medium = $data['interest_medium'] ?? '';
            $tutor->preferred_area_id = ($preferred_area_id) ?? null;
            $tutor->save();
            return  $user;
        } elseif ($data['user_type'] == 'guardian') {
            $user = new User();
            $user->name = $data['name'];
            $user->user_type = $data['user_type'];
            $user->email = $data['email'];
            $user->email_verified_at = Carbon::now();
            $user->phone = $data['phone'];
            $user->phone_verified_at = Carbon::now();
            $user->password = Hash::make($data['password']);
            $user->pwd = $data['password'];
            $user->is_change_pass = 1;
            $user->status = 1;
            $user->save();
            return $user;
        } elseif ($data['user_type'] == 'student') {
            $user = new User();
            $user->name = $data['name'];
            $user->user_type = $data['user_type'];
            $user->email = $data['email'];
            $user->email_verified_at = Carbon::now();
            $user->phone = $data['phone'];
            $user->phone_verified_at = Carbon::now();
            $user->password = Hash::make($data['password']);
            $user->pwd = $data['password'];
            $user->is_change_pass = 1;
            $user->status = 1;
            $user->save();
            return $user;
        }
    }
}
