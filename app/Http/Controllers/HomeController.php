<?php

namespace App\Http\Controllers;

use App\Jobs\SchedulePostJob;
use App\Models\Payment;
use App\Models\PremiumPackageIteme;
use App\Models\Setting;
use App\Models\Upazila;
use App\Models\UserNotification;
use App\Rules\MatchOldPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Traits\FileCustomizeTrait;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tuition;
use App\Models\Tutor;
use App\Models\Page;
use App\Models\TuitionBook;
use App\Models\PremiumPackage;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Area;
use App\Models\Division;
use App\Models\District;
use App\Models\hireBanner;
use App\Models\Medium;
use App\Models\Tclass;
use App\Models\Subject;
use App\Models\Timely;
use App\Models\Weekly;
use App\Models\banner;
use App\Models\Frontnumber;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $percentage = 0;
        //        Artisan::call('migrate');

        if (auth()->check()) {

            if (Auth::user()->phone == null) {
                return view('auth.insert_phone');
            }

            if (auth()->user()->user_type != 'admin') {
                if (Auth::user()->temp_phone_otp != null) {
                    return view('auth.phone_verify');
                }
            }

            if (Auth::user()->user_type == 'tutor') {


                $percentage = 0;

                $tutor = Tutor::where('user_id', Auth::user()->id)->first();
                if (!$tutor) {
                    $tutor = new \App\Models\Tutor();
                    $tutor->user_id = Auth::user()->id;
                    $tutor->save();
                }

                $percentage += $tutor->experience_tuition_percentage;
                $percentage += $tutor->interested_requirement_percentage;
                $percentage += $tutor->personal_information_percentage;
                $percentage += $tutor->academic_qualification_percentage;
                $percentage += $tutor->academic_information_percentage;

                if ($percentage < 70) {
                    return redirect('complete_profile');
                }

                $data['notifications'] = UserNotification::where('user_id', auth()->id())->orderBy('id', 'DESC')->paginate(50);

                return view('frontend.user.tutor.notification', $data);
            } elseif (Auth::user()->user_type == 'admin') {
                $payments = Payment::where('status', 'completed')->get();
                return view('backend.dashboard', compact('payments'));
            } elseif (Auth::user()->user_type == 'student' || Auth::user()->user_type == 'guardian') {
                return redirect('my_tuition_post');
            } else {
                return view('frontend.user.check_user');
            }
        } else {
            return redirect('login');
        }
    }

    public function user_type(Request $request)
    {

        $request->validate([
            'user_type' => [Rule::in(['guardian', 'tutor', 'student'])]
        ]);

        if (Auth::user()->id != '') {
            $user =  User::findOrFail(Auth::user()->id);

            $user->user_type = $request->user_type;
            $user->save();
            if ($user->user_type == 'tutor') {

                $exist =  Tutor::where('user_id', Auth::user()->id)->first();
                if (empty($exist)) {
                    $tutors = Tutor::get()->count();
                    $tutor_code = "ID" . str_pad($tutors + 1, 4, "0", STR_PAD_LEFT);
                    $tutor = new Tutor;
                    $tutor->user_id = $user->id;
                    $tutor->tutor_code = $tutor_code;
                    $tutor->save();
                }
            }
        }
        return redirect('home');
    }
    public function home(Request $request)
    {
        $user = Comment::with('user')->where('status', '1')->get();
        $data['areas'] = Area::all();
        $data['subjects'] = Subject::all();
        $data['mediums'] = Medium::all();
        $data['request'] = $request;
        $search_result = $this->form_search_tutor($request);
        $tutors = Tutor::where('status', '1')->where($search_result);
        $data['tutors'] = $tutors->paginate(10);
        $welcome = Setting::select(['welcome_image', 'welcome_short_title_on_image', 'welcome_title_on_image', 'welcome_dark_overlay_on_image'])->first();
        $banners = banner::all();
        $search_result = $this->form_search($request);
        $tuitions = Tuition::where($search_result)->orderBy('id', 'DESC')->limit(32)->get();

        // Pass all data in a single array
        return view('frontend.index', compact('tuitions', 'welcome', 'banners', 'data', 'request', 'user'));
    }

    public function number_store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'phone' => 'required|numeric|digits:11',
        ]);
        $numbers = new Frontnumber();
        $numbers->phone = $request->phone;
        $numbers->save();
        // dd($numbers);
        return redirect()->back()->with('success', 'Phone number submitted successfully.');
    }

    public function tuitions()
    {
        return view('frontend.tuitions');
    }
    public function my_tuition()
    {

        //                if(Auth::user()->email_verified_at == ''){
        //                    return view('auth.verify');
        //                }

        //                if(Auth::user()->phone_verified_at == null){
        //                    return view('auth.phone_verify');
        //                }

        $percentage = 0;

        $tutor = Tutor::where('user_id', Auth::user()->id)->first();
        if (!$tutor) {
            $tutor = new \App\Models\Tutor();
            $tutor->user_id = Auth::user()->id;
            $tutor->save();
        }

        $percentage += $tutor->experience_tuition_percentage;
        $percentage += $tutor->interested_requirement_percentage;
        $percentage += $tutor->personal_information_percentage;
        $percentage += $tutor->academic_qualification_percentage;
        $percentage += $tutor->academic_information_percentage;

        if ($percentage < 70) {
            return redirect('complete_profile');
        }

        $my_tuition = TuitionBook::where('user_id', auth()->id())->get();

        return view('frontend.user.tutor.dashboard', compact('tutor', 'my_tuition'));


        //        $data['my_tuition'] = TuitionBook::where('user_id',Auth::user()->id)->get();
        //
        //        return view('frontend.user.tutor.my_tuition',$data);
    }




    public function my_apply()
    {
        $data['my_tuition'] = TuitionBook::where('user_id', Auth::user()->id)->get();

        return view('frontend.user.student.my_tuition', $data);
    }
    public function my_tuition_post()
    {
        $data['my_tuition'] = Tuition::with('tuition_books')->where('user_id', Auth::user()->id)->get();
        return view('frontend.user.student.my_tuition_post', $data);
    }
    public function create_tuition()
    {
        return redirect('/');
        $data['divitions'] = Division::all();
        $data['districts'] = District::all();
        $data['mediums'] = Medium::all();
        $data['tclass'] = Tclass::all();
        $data['subjects'] = Subject::all();
        $data['timelys'] = Timely::all();
        $data['weeklys'] = Weekly::all();
        $data['areas'] = Area::all();

        $data['users'] = User::where('status', '1')->where('user_type', 'student')->orwhere('user_type', 'guardian')->get();
        $post = Tuition::get()->count();
        $code = "ID" . str_pad($post + 1, 5, "0", STR_PAD_LEFT);
        return view('frontend.user.student.create_tuition', $data, compact('code'));
    }
    public function tuition_store(Request $request)
    {
        // Redirect to home (temporary, remove if not needed)
        return redirect('/');

        $this->validate($request, [
            'division_id' => 'required',
            'district_id' => 'required',
            'area_id' => 'required',
            'contact_phone' => 'required',
            'title' => 'required',
        ]);
        $tuition = new Tuition;
        if ($request->has('schedule_date_time')) {
            // Schedule post for later
            $tuition = new Tuition;
            $tuition->user_id = Auth::user()->id;
            $tuition->division_id = $request->division_id;
            $tuition->district_id = $request->district_id;
            $tuition->area_id = $request->area_id;
            $tuition->address = $request->address;
            $tuition->gender = $request->gender;
            $tuition->tclass = $request->tclass;
            $tuition->phone = $request->contact_phone;
            $tuition->student_number = $request->student_number;
            $tuition->duration = $request->duration;
            $tuition->institution = $request->institution;
            $tuition->subject_ids = $request->subject_ids;
            $tuition->name = $request->title;
            $tuition->interest_medium = $request->interest_medium;
            $tuition->interest_class = $request->interest_class;
            $tuition->interest_gender = $request->interest_gender;
            $tuition->interest_sub = $request->interest_sub;
            $tuition->interest_time = $request->interest_time;
            $tuition->interest_institution = $request->interest_institution;
            $tuition->weekly = $request->weekly;
            $tuition->student_medium = $request->student_medium;
            $tuition->hiring_date = $request->hiring_date;
            $tuition->status = '0';
            $tuition->class_type = $request->class_type;
            $tuition->salary_show_hide = $request->salary_show_hide;
            $tuition->details = $request->details;
            $tuition->created_by = Auth::user()->id;

            $tuitions = Tuition::get()->count();
            $code = $tuitions + 1;
            $tuition->job_id = $code;
            $tuition->salary = $request->salary;
            $tuition->save();
        } else {
            // Create the post immediately
            $this->createPost($tuition);
        }

        return redirect()->route('my_tuition_post')->with('success', 'Tuition Created Successfully');
    }

    protected function schedulePost(Tuition $tuition, $scheduleDateTime)
    {
        // Schedule a task to create the post at the specified time
        $scheduleDateTime = Carbon::parse($scheduleDateTime);

        $job = new SchedulePostJob($tuition); // Create a job to handle the scheduled post
        dispatch($job)->delay($scheduleDateTime);
    }

    protected function createPost(Tuition $tuition)
    {
        $tuition->status = '0';
        $tuitions = Tuition::get()->count();
        $code = $tuitions + 1;
        $tuition->job_id = $code;
        $tuition->save();
    }

    public function tuition_edit(Request $request, $id)
    {
        return redirect('/');
        $data['divitions'] = Division::all();
        $data['districts'] = District::all();
        $data['mediums'] = Medium::all();
        $data['tclass'] = Tclass::all();
        $data['subjects'] = Subject::all();
        $data['timelys'] = Timely::all();
        $data['weeklys'] = Weekly::all();
        $data['areas'] = Area::all();
        $data['users'] = User::where('status', '1')->where('user_type', 'Student')->orwhere('user_type', 'Guardian')->get();
        $tuitions = Tuition::findOrFail($id);
        return view('frontend.user.student.edit_tuition', $data, compact('tuitions'));
    }
    public function tuition_delete($id)
    {
        $user =   User::where('id', $id)->first();
        $user->status = 0;
        $user->update();
        Auth::logout();
        return redirect()->route('index');
    }
    public function tuition_update(Request $request, $id)
    {
        return redirect('/');
        $this->validate($request, [
            'division_id' => 'required',
            'district_id' => 'required',
            'area_id' => 'required',
            'contact_phone' => 'required',
            'title' => 'required',
        ]);

        $tuition = Tuition::findOrFail($id);
        $tuition->user_id = Auth::user()->id;
        $tuition->division_id = $request->division_id;
        $tuition->district_id = $request->district_id;
        $tuition->area_id = $request->area_id;
        $tuition->address = $request->address;

        $tuition->gender = $request->gender;
        $tuition->tclass = $request->tclass;
        $tuition->phone = $request->contact_phone;
        $tuition->student_number = $request->student_number;
        $tuition->duration = $request->duration;
        $tuition->institution = $request->institution;
        $tuition->subject_ids = $request->subject_ids;
        $tuition->name = $request->title;
        $tuition->interest_medium = $request->interest_medium;
        $tuition->interest_class = $request->interest_class;
        $tuition->interest_gender = $request->interest_gender;
        $tuition->interest_sub = $request->interest_sub;
        $tuition->interest_time = $request->interest_time;
        $tuition->interest_institution = $request->interest_institution;
        $tuition->weekly = $request->weekly;
        $tuition->class_type = $request->class_type;
        $tuition->student_medium = $request->student_medium;
        $tuition->hiring_date = $request->hiring_date;
        $tuition->salary_show_hide = $request->salary_show_hide;
        $tuition->details = $request->details;
        $tuition->salary = $request->salary;
        $tuition->save();

        return redirect()->route('my_tuition_post')->with('success', 'Tuition Created Successfully');
    }

    public function profile(Request $request)
    {

        $data['divitions'] = Division::all();
        $data['districts'] = District::all();
        $data['areas'] = Area::all();
        $data['upazilas'] = Upazila::all();
        $data['mediums'] = Medium::all();
        $data['tclass'] = Tclass::all();
        $data['subjects'] = Subject::all();
        $data['timelys'] = Timely::all();
        $data['weeklys'] = Weekly::all();
        $data['packages'] = PremiumPackage::all();
        $tutor = Tutor::where('user_id', Auth::user()->id)->first();

        //        if($request->type == 'academic_information'){
        //            return view('frontend.user.tutor.profile.academic_information',$data,compact('tutor'));
        //        }
        //        if($request->type == 'academic_qualification'){
        //            return view('frontend.user.tutor.profile.academic_qualification',$data,compact('tutor'));
        //        }
        //        if($request->type == 'personal_information'){
        //            return view('frontend.user.tutor.profile.personal_information',$data,compact('tutor'));
        //        }
        //        if($request->type == 'interested_requirement'){
        //            return view('frontend.user.tutor.profile.interested_requirement',$data,compact('tutor'));
        //        }
        //        if($request->type == 'tuition_experience'){
        //            return view('frontend.user.tutor.profile.tuition_experience',$data,compact('tutor'));
        //        }

        return view('frontend.user.tutor.profile.index', $data, compact('tutor'));
    }

    public function notification(Request $request)
    {

        $data['notifications'] = UserNotification::where('user_id', auth()->id())->orderBy('id', 'DESC')->paginate(50);

        return view('frontend.user.tutor.notification', $data);
    }

    public function edit_account(Request $request)
    {
        $tutor = Tutor::where('user_id', Auth::user()->id)->first();
        $user = User::where('id', Auth::user()->id)->first();
        if ($request->type == 'academic') {
            $data['divitions'] = Division::all();
            $data['districts'] = District::all();
            $data['areas'] = Area::all();
            $data['upazilas'] = Upazila::all();
            $data['mediums'] = Medium::all();
            $data['tclass'] = Tclass::all();
            $data['subjects'] = Subject::all();
            $data['timelys'] = Timely::all();
            $data['weeklys'] = Weekly::all();
            $data['packages'] = PremiumPackage::all();
            return view('frontend.user.tutor.complete_profile.academic_information', $data, compact('tutor','user'));
        } elseif ($request->type == 'basic') {
            return view('frontend.user.tutor.profile.edit_basic_information', compact('tutor','user'));
        }
    }

    public function update_basic_information(Request $data)
    {

        $data->validate([
            'whatsapp' => ['required'],
            'gender' => ['required'],
            'permanent_district_id' => ['required'],
            'district_id' => ['required'],
            'thana_id' => ['required'],
            //            'area_id' => ['required'],
            'interest_class' => ['required'],
            'interest_sub' => ['required'],
            'interest_medium' => ['required'],
            //            'preferred_area_id' => ['required'],
        ]);

        $user = User::findOrFail(auth()->id());
        $user->name = $data['name'];
        $old_phone = $user->phone;
        $user->phone = $data['phone'];
        $user->whatsapp = $data['whatsapp'];
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

        $tutor = Tutor::where('user_id', auth()->id())->first();
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

        if ($old_phone != $data['phone']) {
            $this->phone_number_change($user, $data);
            return redirect('home');
        } else {
            return back()->withSuccess('Data Updated Successfully');
        }
    }

    protected function phone_number_change($user, $data)
    {
        $user->phone_verified_at = null;
        $user->temp_phone_otp = rand(11111, 99999);
        $user->save();
        $sms_text = 'OTP code to login-' . $user->temp_phone_otp;
        sendSms($user->phone, $sms_text);
    }

    public function complete_profile(Request $request)
    {

        $percentage = 0;

        $tutor = Tutor::where('user_id', Auth::user()->id)->first();
        if (!$tutor) {
            $tutor = new \App\Models\Tutor();
            $tutor->user_id = Auth::user()->id;
            $tutor->save();
        }


        $percentage += $tutor->experience_tuition_percentage;
        $percentage += $tutor->interested_requirement_percentage;
        $percentage += $tutor->personal_information_percentage;
        $percentage += $tutor->academic_qualification_percentage;
        $percentage += $tutor->academic_information_percentage;

        //dd($percentage);

        if ($percentage > 70) {
            return redirect('home');
        }

        $data['divitions'] = Division::all();
        $data['districts'] = District::all();
        $data['areas'] = Area::all();
        $data['upazilas'] = Upazila::all();
        $data['mediums'] = Medium::all();
        $data['tclass'] = Tclass::all();
        $data['subjects'] = Subject::all();
        $data['timelys'] = Timely::all();
        $data['weeklys'] = Weekly::all();
        $data['packages'] = PremiumPackage::all();
        $tutor = Tutor::where('user_id', Auth::user()->id)->first();

        if ($request->type == 'academic_information') {
            return view('frontend.user.tutor.complete_profile.academic_information', $data, compact('tutor'));
        }

        //        if($request->type == 'personal_information'){
        //            return view('frontend.user.tutor.complete_profile.personal_information',$data,compact('tutor'));
        //        }

        return view('frontend.user.tutor.complete_profile.academic_information', $data, compact('tutor'));
    }


    public function tutor_complete_profile_update(Request $request)
    {
        //return "connection okk";

        $id = auth()->id();
        $tutor = Tutor::where('user_id', $id)->first();

        //return $tutor;

        if (!$tutor) return back();

        if ($request->profile_information_type == 'academic_information') {
            //return "acadamick info";
            $request->validate([
                'institution' => ['nullable', 'max:100'],
                'faculty' => ['nullable', 'max:100'],
                'institute_type' => ['nullable', 'max:100'],
                'hons_medium' => ['nullable', 'max:100'],
                'subject_name' => ['nullable', 'max:100'],
                'sessions' => ['nullable', 'max:100'],
                'hons_last_passed_year' => ['nullable', 'max:100'],
                'hons_last_passed_result' => ['nullable', 'max:100'],
                'hsc_institute' => ['nullable', 'max:100'],
                'hsc_group' => ['nullable', 'max:100'],
                'hsc_medium' => ['nullable', 'max:100'],
                'hsc_result' => ['nullable', 'max:100'],
                'hsc_year' => ['nullable', 'max:100'],
                'ssc_institute' => ['nullable', 'max:100'],
                'ssc_group' => ['nullable', 'max:100'],
                'ssc_medium' => ['nullable', 'max:100'],
                'ssc_result' => ['nullable', 'max:100'],
                'ssc_year' => ['nullable', 'max:100'],
                'student_id_card' => ['mimes:jpg,jpeg,png'],
                'details' => ['nullable', 'max: 500'],
            ]);

            if ($request->hasFile('student_id_card')) {
                FileCustomizeTrait::deleteFile($request->student_id_card);

                $file = $request->file('student_id_card');
                $fileName =  uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/storages/tutor_student_cards/';
                $file->move($destinationPath, $fileName);
                $tutor->student_id_card = '/storages/tutor_student_cards/' . $fileName;
            }

            $tutor->institution = $request->institution;
            $tutor->faculty = $request->faculty;
            $tutor->institute_type = $request->institute_type;
            $tutor->hons_medium = $request->hons_medium;
            $tutor->subject_id = $request->subject_id;
            $tutor->subject_name = $request->subject_name;
            $tutor->session = $request->sessions;
            $tutor->year_of_study = $request->hons_last_passed_year;
            $tutor->hons_last_passed_year = $request->hons_last_passed_year;
            $tutor->hons_last_passed_result = $request->hons_last_passed_result;
            $tutor->hall = $request->hall;

            $tutor->hsc_institute = $request->hsc_institute;
            $tutor->hsc_group = $request->hsc_group;
            $tutor->hsc_medium = $request->hsc_medium;
            $tutor->hsc_result = $request->hsc_result;
            $tutor->hsc_year = $request->hsc_year;

            $tutor->ssc_institute = $request->ssc_institute;
            $tutor->ssc_group = $request->ssc_group;
            $tutor->ssc_medium = $request->ssc_medium;
            $tutor->ssc_result = $request->ssc_result;
            $tutor->ssc_year = $request->ssc_year;

            $tutor->details = $request->details;
            $tutor->interest_time = $request->time;

            $tutor->academic_information_percentage = 20;
            $tutor->academic_qualification_percentage = 20;
            $tutor->personal_information_percentage = 20;
            $tutor->interested_requirement_percentage = 20;
            $tutor->experience_tuition_percentage = $request->experience;
            $tutor->status = 1;

            $tutor->father_name = $request->father_name;
            $tutor->father_number = $request->father_number;
            $tutor->mother_name = $request->mother_name;
            $tutor->mother_number = $request->mother_number;

            $tutor->gender = $request->gender;
            $tutor->facebook_link = $request->facebook_link;

            $tutor->preferred_area_id = $request->preferred_area_id;
            $tutor->area_id = $request->area_id;

//            $tutor->interest_location = $request->interest_location;
            $tutor->interest_medium = $request->interest_medium;
//            $tutor->interest_class = $request->interest_class;
//            $tutor->interest_gender = $request->interest_gender;
//            $tutor->interest_sub = $request->interest_sub;
//            $tutor->interest_time = $request->interest_time;
//            $tutor->weekly = $request->weekly;
            $tutor->salary = $request->salary;

            $tutor->save();

            $user = User::findOrFail($id);
            if ($request->hasFile('avatar')) {
                FileCustomizeTrait::deleteFile($request->avatar);

                $file = $request->file('avatar');
                $fileName =  uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/storages/tutor/';
                $file->move($destinationPath, $fileName);
                $user->avatar = '/storages/tutor/' . $fileName;
                $user->save();
            }

            return redirect('complete_profile?type=personal_information')->withSuccess('Academic Information stored successfully');
        }



        if ($request->profile_information_type == 'personal_information') {

            $this->validate($request, [
                'name' => 'required',
                'phone' => ['required', 'numeric', 'digits:11', Rule::unique('users', 'phone')->ignore($id)],
                //                'email' => ['required','email',Rule::unique('users','email')->ignore($id)]
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            //            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->whatsapp = $request->whatsapp;
            //            $user->nid_number = $request->nid_number;



            if ($request->hasFile('nid')) {
                FileCustomizeTrait::deleteFile($request->nid);
                $file = $request->file('nid');
                $fileName =  uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/storages/nid/';
                $file->move($destinationPath, $fileName);
                $user->nid = '/storages/nid/' . $fileName;
            }
            $user->user_type = 'tutor';
            $user->save();

            $tutor->division_id = $request->division_id;
            $tutor->district_id = $request->district_id;
            $tutor->area_id = $request->area_id;
            $tutor->address = $request->address;

            $tutor->permanent_address = $request->permanent_address;
            $tutor->permanent_upazila_id = $request->permanent_upazila_id;
            $tutor->permanent_district_id = $request->permanent_district_id;
            $tutor->permanent_division_id = $request->permanent_division_id;

            $tutor->parent_address = $request->parent_address;
            $tutor->parent_upazila_id = $request->parent_upazila_id;
            $tutor->parent_district_id = $request->parent_district_id;
            $tutor->parent_division_id = $request->parent_division_id;
//            $tutor->father_name = $request->father_name;
//            $tutor->father_number = $request->father_number;
//            $tutor->mother_name = $request->mother_name;
//            $tutor->mother_number = $request->mother_number;
//
//            $tutor->gender = $request->gender;
//            $tutor->date_of_birth = $request->date_of_birth;
//            $tutor->facebook_link = $request->facebook_link;
//
//            $tutor->city_id = $request->city_id;
//            $tutor->preferred_area_id = $request->preferred_area_id;
//            $tutor->area_id = $request->area_id;
//
////            $tutor->interest_location = $request->interest_location;
//            $tutor->interest_medium = $request->interest_medium;
////            $tutor->interest_class = $request->interest_class;
////            $tutor->interest_gender = $request->interest_gender;
////            $tutor->interest_sub = $request->interest_sub;
////            $tutor->interest_time = $request->interest_time;
////            $tutor->weekly = $request->weekly;
//            $tutor->salary = $request->salary;

            $tutor->personal_information_percentage = 20;
            $tutor->interested_requirement_percentage = 20;
            $tutor->experience_tuition_percentage = 20;
            $tutor->status = 1;

            $tutor->save();
            return redirect('complete_profile?type=profile')->withSuccess('Personal Information Stored successfully');
        }

        return redirect()->back()
            ->with('success', 'Tutor Update successfully.');
    }


    public function tutor_profile_update(Request $request)
    {

        $id = auth()->id();
        $tutor = Tutor::where('user_id', $id)->first();

        if (!$tutor) return back();

        if ($request->profile_information_type == 'academic_information') {

            if ($request->hasFile('student_id_card')) {
                FileCustomizeTrait::deleteFile($request->student_id_card);

                $file = $request->file('student_id_card');
                $fileName =  uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/storages/tutor_student_cards/';
                $file->move($destinationPath, $fileName);
                $tutor->student_id_card = '/storages/tutor_student_cards/' . $fileName;
            }

            $tutor->institution = $request->institution;
            $tutor->subject_id = $request->subject_id;
            $tutor->session = $request->sessions;
            $tutor->year_of_study = $request->year_of_study;
            $tutor->hall = $request->hall;
            //            $tutor->academic_information_percentage = 20;
            $tutor->save();
            return redirect('profile?type=academic_qualification')->withSuccess('Academic Information stored successfully');
        }





        if ($request->profile_information_type == 'academic_qualification') {

            if ($request->hasFile('hons_marksheet')) {
                FileCustomizeTrait::deleteFile($request->hons_marksheet);

                $file = $request->file('hons_marksheet');
                $fileName =  uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/storages/tutor_marksheets/';
                $file->move($destinationPath, $fileName);
                $tutor->hons_marksheet = '/storages/tutor_marksheets/' . $fileName;
            }
            if ($request->hasFile('hsc_marksheet')) {
                FileCustomizeTrait::deleteFile($request->hsc_marksheet);

                $file = $request->file('hsc_marksheet');
                $fileName =  uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/storages/tutor_marksheets/';
                $file->move($destinationPath, $fileName);
                $tutor->hsc_marksheet = '/storages/tutor_marksheets/' . $fileName;
            }
            if ($request->hasFile('ssc_marksheet')) {
                FileCustomizeTrait::deleteFile($request->ssc_marksheet);

                $file = $request->file('ssc_marksheet');
                $fileName =  uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/storages/tutor_marksheets/';
                $file->move($destinationPath, $fileName);
                $tutor->ssc_marksheet = '/storages/tutor_marksheets/' . $fileName;
            }


            $tutor->ssc_year = $request->ssc_year;
            $tutor->ssc_result = $request->ssc_result;
            $tutor->ssc_group = $request->ssc_group;
            $tutor->ssc_medium = $request->ssc_medium;
            $tutor->hsc_year = $request->hsc_year;
            $tutor->hsc_result = $request->hsc_result;
            $tutor->hsc_group = $request->hsc_group;
            $tutor->hons_last_passed_year = $request->hons_last_passed_year;
            $tutor->hons_last_passed_result = $request->hons_last_passed_result;
            $tutor->hons_subject = $request->hons_subject;
            //            $tutor->academic_qualification_percentage = 20;

            $tutor->save();
            return redirect('profile?type=personal_information')->withSuccess('Academic Qualification stored successfully');
        }



        if ($request->profile_information_type == 'personal_information') {

            $this->validate($request, [
                'name' => 'required',
                'phone' => ['required', 'numeric', 'digits:11', Rule::unique('users', 'phone')->ignore($id)],
                //                'email' => ['required','email',Rule::unique('users','email')->ignore($id)]
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            //            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->whatsapp = $request->whatsapp;
            $user->nid_number = $request->nid_number;

            if ($request->hasFile('image')) {
                FileCustomizeTrait::deleteFile($request->avatar);
                $file = $request->file('image');
                $fileName =  uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/storages/tutor/';
                $file->move($destinationPath, $fileName);
                $user->avatar = '/storages/tutor/' . $fileName;
            }
            if ($request->hasFile('nid')) {
                FileCustomizeTrait::deleteFile($request->nid);
                $file = $request->file('nid');
                $fileName =  uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/storages/nid/';
                $file->move($destinationPath, $fileName);
                $user->nid = '/storages/nid/' . $fileName;
            }
            $user->user_type = 'tutor';
            $user->save();

            $tutor->division_id = $request->division_id;
            $tutor->district_id = $request->district_id;
            $tutor->area_id = $request->area_id;
            $tutor->address = $request->address;

            $tutor->permanent_address = $request->permanent_address;
            $tutor->permanent_upazila_id = $request->permanent_upazila_id;
            $tutor->permanent_district_id = $request->permanent_district_id;
            $tutor->permanent_division_id = $request->permanent_division_id;

            $tutor->parent_address = $request->parent_address;
            $tutor->parent_upazila_id = $request->parent_upazila_id;
            $tutor->parent_district_id = $request->parent_district_id;
            $tutor->parent_division_id = $request->parent_division_id;
            $tutor->father_name = $request->father_name;
            $tutor->father_number = $request->father_number;
            $tutor->mother_name = $request->mother_name;
            $tutor->mother_number = $request->mother_number;

            $tutor->gender = $request->gender;
            $tutor->date_of_birth = $request->date_of_birth;
            $tutor->facebook_link = $request->facebook_link;

            //            $tutor->personal_information_percentage = 20;

            $tutor->save();
            return redirect('profile?type=interested_requirement')->withSuccess('Personal Information Stored successfully');
        }




        if ($request->profile_information_type == 'interested_requirement') {
            $tutor->interest_location = $request->interest_location;
            $tutor->interest_medium = $request->interest_medium;
            $tutor->interest_class = $request->interest_class;
            $tutor->interest_gender = $request->interest_gender;
            $tutor->interest_sub = $request->interest_sub;
            $tutor->interest_time = $request->interest_time;
            $tutor->weekly = $request->weekly;
            $tutor->salary = $request->salary;
            //            $tutor->interested_requirement_percentage = 20;
            $tutor->save();

            return redirect('profile?type=tuition_experience')->withSuccess('Interested Requirements Stored successfully');
        }


        if ($request->profile_information_type == 'tuition_experience') {
            $tutor->details = $request->details;
            //            $tutor->experience_tuition_percentage = 20;
            $tutor->save();
        }

        return redirect()->back()
            ->with('success', 'Tutor Update successfully.');
    }



    public function tutor_pasword_change()
    {
        return redirect('/');
        $tutor = Tutor::where('user_id', Auth::user()->id)->first();

        return view('frontend.user.tutor.password', compact('tutor'));
    }
    public function tutor_pasword_change_store(Request  $request)
    {
        return redirect('/');
        $request->validate([
            'old_password' => ['required',  new MatchOldPassword],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $tutor = Tutor::where('user_id', Auth::user()->id)->first();
        if ($tutor) {
            $user = User::where('id', Auth::user()->id)->first();
            $user->password = $request->password;
            $user->save();
        }

        return back()->withSuccess('Password Updated');
    }

    public function student_pasword_change()
    {
        return redirect('/');
        $student = Tutor::where('user_id', Auth::user()->id)->first();

        return view('frontend.user.student.password', compact('student'));
    }
    public function student_pasword_change_store(Request  $request)
    {
        return redirect('/');
        $request->validate([
            'old_password' => ['required',  new MatchOldPassword],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $student = Tutor::where('user_id', Auth::user()->id)->first();
        if ($student) {
            $user = User::where('id', Auth::user()->id)->first();
            $user->password = $request->password;
            $user->save();
        }

        return back()->withSuccess('Password Updated');
    }

    public function student_profile()
    {
        return view('frontend.user.student.profile');
    }

    public function opinion()
    {
        return view('frontend.user.student.opinion');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'opinion' => 'required',
        ]);

        $user = new Comment();
        $user->body = $request->opinion;
        $user->save();
        return redirect()->back()
            ->with('success', 'Your opinion add successfully.');
    }

    public function studnt_profile_update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            // 'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if (!empty($request->password)) {
            $user->password = $request->password;
        }

        //$user->status =$request->status;
        if ($request->hasFile('image')) {
            FileCustomizeTrait::deleteFile($request->avatar);
            $file = $request->file('image');
            $fileName =  uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/storages/tutor/';
            $file->move($destinationPath, $fileName);
            $user->avatar = '/storages/tutor/' . $fileName;
        }
        $user->save();
        return redirect()->back()
            ->with('success', 'Profile Update successfully.');
    }


    public function registration(Request $request)
    {
        //return "connection okkk";
        if (auth()->check()) {
            return redirect('/login');
        }
        $register_type = '';
        if ($request->register_type == 'guardian') {
            $register_type = 'guardian';
        } elseif ($request->register_type == 'student') {
            $register_type = 'student';
        } elseif ($request->register_type == 'tutor') {
            $register_type = 'tutor';
        }
        return view('auth.registration', compact('register_type'));
    }


    public function tutor_registration(Request $request)
    {
        //return "connection okk";
        return redirect('registration');
    }


    public function tutor_list(Request $request)
    {
        $data['areas'] = Area::all();
        $data['subjects'] = Subject::all();
        $data['mediums'] = Medium::all();
        $data['request'] = $request;
        $search_result = $this->form_search_tutor($request);
        $tutors = Tutor::where('status', '1')->where($search_result);
        $data['tutors'] = $tutors->paginate(24);
        return view('frontend.tutor_list', $data);
    }

    private function form_search_tutor($request)
    {
        $search_items = [];
        if ($request->area_id) {
            $search_items[] = ['area_id', '=', $request->area_id];
        }
        if ($request->subject_id) {
            $search_items[] = ['subject_id', '=', $request->subject_id];
        }
        if ($request->medium_id) {
            $search_items[] = ['ssc_medium', '=', $request->medium_id];
            $search_items[] = ['hsc_medium', '=', $request->medium_id];
        }
        if ($request->gender) {
            $search_items[] = ['gender', '=', $request->gender];
        }
        if ($request->search_input) {
            $search_items[] = ['institution', 'like', '%' .  $request->search_input . '%'];
        }
        return $search_items;
    }
    public function tutor_profile(Request $request, $id)
    {
        $tutor_profile =  Tutor::where('id', $id)->first();
        if (!empty($tutor_profile)) {
            return view('frontend.tutor_profile', compact('tutor_profile'));
        } else {
            abort(404);
        }
    }
    public function tuition_list(Request $request)
    {
        // dd($request->all());


        $search_result = $this->form_search($request);
        $data['areas'] = Area::all();
        $data['classes'] = Tclass::all();
        $data['subjects'] = Subject::all();
        $data['request'] = $request;

        if ($request->gender) {
            $tuitions = Tuition::where('status', '!=', '0')->where($search_result)->WhereJsonContains('gender', "{$request->gender}")->orderBy('created_at', 'DESC')->orderBy('status', 'ASC');
        } else {
            $tuitions = Tuition::where('status', '!=', '0')->where($search_result)->orderBy('created_at', 'DESC')->orderBy('status', 'ASC');
        }

        $data['tuitions'] = $tuitions->paginate(8);
        return view('frontend.tuition_list', $data);
    }

    private function form_search($request)
    {

        $search_items = [];
        if ($request->tuition_category) {
            $search_items[] = ['tuition_category', '=', $request->tuition_category];
        }
        if ($request->area_id) {
            $search_items[] = ['area_id', '=', $request->area_id];
        }
        if ($request->tuition_id) {
            $search_items[] = ['job_id', '=', $request->tuition_id];
        }
        if ($request->class_id) {
            $search_items[] = ['interest_class', '=', $request->class_id];
        }
        if ($request->class_id) {
            $search_items[] = ['tclass', '=', $request->class_id];
        }
        if ($request->subject_id) {
            $subject = (Subject::where('name', $request->subject_id)->first());
            if ($subject) {
                $subject_id = $subject->id;
                $search_items[] = ['subject_ids', $subject_id];
            }
        }
        if ($request->search_input) {
            $search_items[] = ['name', 'like', '%' . $request->search_input . '%'];
        }
        return $search_items;
    }

    public function tuition_details(Request $request, $tuition_id)
    {

        $tuition =  Tuition::where('id', $request->id)->first();
        if ($tuition) {
            $comments =  Comment::where('tuition_id', $tuition->id)->where('status', 1)->get();
        } else {
            return abort('404');
        }


        if (!empty($tuition)) {
            return view('frontend.tuition_details', compact('tuition', 'comments'));
        } else {
            abort(404);
        }
    }
    public function pages(Request $request, $slug)
    {
        $page_details =  Page::where('slug', $slug)->first();
        if (!empty($page_details)) {
            return view('frontend.page_details', compact('page_details'));
        } else {
            abort(404);
        }
    }
    public function package_list()
    {
        $packages = PremiumPackage::with('items')->where('status', '1');
        //       return $packages;
        $data['packages'] = $packages->paginate(8);
        $data['premium_package_items'] = PremiumPackageIteme::get();
        return view('frontend.package_list', $data);
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contact_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        Contact::create($request->all());
        return redirect()->route('contact_page')->with('success', 'Message Sent Successfully. We will contact you as soon as possible.');
    }
    public function review_comment(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'tuition_id' => 'required',
            'user_id' => 'required',
        ]);
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->tuition_id = $request->tuition_id;
        $comment->body = $request->body;
        $comment->status = 0;
        $comment->verified = 0;
        $comment->anonymous = 0;
        $comment->save();
        return redirect()->back()->with('success', 'Your Comment Successfully');
    }


    public function tution_book_apply(Request $request)
    {

        if (auth()->user() != null && Auth::user()->user_type == "tutor" && Auth::user()->user_type != 'admin') {
            $tuition =  Tuition::where('id',  $request->tuition_id)->first();
            $tutor =  Tutor::where('user_id',  Auth::user()->id)->first();

            $percent = $tutor->experience_tuition_percentage + $tutor->interested_requirement_percentage + $tutor->personal_information_percentage + $tutor->academic_qualification_percentage + $tutor->academic_information_percentage;

            if ($percent < 70) {
                return back()->withErrors('Please complete your profile');
            }

            if (empty($tutor) && $tutor->status == 0) {
                return redirect()->route('home')->with('error', 'Your Profile is not Updated Or Not Approved');
            }

            $tuition_book = TuitionBook::where('tuition_id', $tuition->id)->where('tutor_id', $tutor->id)->first();
            if ($tuition_book == null) {
                $tuition_book = new TuitionBook;
            } else {
                return back()->with('error', 'An Application already submitted');
            }
            $tuition_book->tuition_id = $tuition->id;
            $tuition_book->tutor_id = $tutor->id;
            $tuition_book->user_id = Auth::user()->id;
            $tuition_book->salary = $tuition->salary;
            $tuition_book->payment_status = 'pending';
            $tuition_book->details = '';
            $tuition_book->tutor_urgency = $request->tutor_urgency;
            $tuition_book->status = 2;
            $tuition_book->save();
            return redirect()->back()->with('success', 'Tuition Book Apply successfully.');
        } else {
            return redirect('registration?register_type=student')->with('error', 'Login or Registration First');
        }
    }

    public function unapply_tuition(Request $request)
    {

        if (auth()->user() != null && Auth::user()->user_type == "tutor" && Auth::user()->user_type != 'admin') {
            $tuition =  Tuition::where('id',  $request->tuition_id)->first();
            $tutor =  Tutor::where('user_id',  Auth::user()->id)->first();

            $percent = $tutor->experience_tuition_percentage + $tutor->interested_requirement_percentage + $tutor->personal_information_percentage + $tutor->academic_qualification_percentage + $tutor->academic_information_percentage;

            if ($percent < 70) {
                return back()->withErrors('Please complete your profile');
            }

            if (empty($tutor) && $tutor->status == 0) {
                return redirect()->route('home')->with('error', 'Your Profile is not Updated Or Not Approved');
            }

            $tuition_book = TuitionBook::where('tuition_id', $tuition->id)->where('tutor_id', $tutor->id)->first();
            if ($tuition_book == null) {
                return abort('404');
            }

            $tuition_book->delete();
            return redirect()->back()->with('success', 'Tuition Application Unapplied.');
        } else {
            return redirect('registration?register_type=student')->with('error', 'Login or Registration First');
        }
    }



    public function tutor_book_apply(Request $request)
    {
        if (auth()->user() != null && Auth::user()->user_type != "tutor" && Auth::user()->user_type != 'admin') {
            $tutor =  Tutor::where('id',  $request->tutor_id)->first();
            $tuition = new TuitionBook;
            //$tuition->tuition_id =$request->tuition_id;
            $tuition->tutor_id = $tutor->id;
            $tuition->user_id = Auth::user()->id;
            $tuition->salary = $tutor->salary;
            $tuition->payment_status = 'pending';
            $tuition->details = '';
            $tuition->status = '0';
            $tuition->save();
            return redirect()->back()->with('success', 'Tuition Book Apply successfully.');
        } else {
            return redirect('/registration?register_type=guardian')->with('error', 'Login or Registration First');
        }
    }
    public function getDistrictByDivition(Request $request)
    {

        return HelperTrait::getDistrictByDivition($request);
    }

    public function getAreaByDistrict(Request $request)
    {
        return HelperTrait::getAreaByDistrict($request);
    }

    public function getThanaByDistrict(Request $request)
    {
        return HelperTrait::getThanaByDistrict($request);
    }

    public function getAreaByThana(Request $request)
    {
        return HelperTrait::getAreaByThana($request);
    }
    public function getAreaByThana_sameValue(Request $request)
    {
        return HelperTrait::getAreaByThana_sameValue($request);
    }
    public function getAreaByThanaArray(Request $request)
    {
        return HelperTrait::getAreaByThanaArray($request);
    }
    public function getAreaByThanaArray2(Request $request)
    {
        return HelperTrait::getAreaByThanaArray2($request);
    }

    public function add_reaction(Request $request)
    {

        $tuition = tuition::where('id', $request->id)->first();
        $options = $tuition->reaction + 1;
        $tuition->reaction = $options;
        $tuition->save();
        return response()->json([
            'options' => $options
        ]);
    }

    function checkDuplicateEmailForUser(Request $request)
    {
        $email = $request->email;
        $data = '2';
        if (!empty($email)) :
            if (!empty($request->id)) {
                $exitsSup =  User::where('email', $request->email)->where('id', '!=', $request->id)->first();
            } else {
                $exitsSup =  User::where('email', $request->email)->first();
            }


            if (!empty($exitsSup)) {
                $data = "1";
            } else {
                $data = '2';
            }
        else :
            $data = '2';
        endif;
        return response()->json($data);
    }
}
