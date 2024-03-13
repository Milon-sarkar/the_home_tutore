<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Comment;
use App\Models\GuardianStudent;
use App\Models\Tuition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use App\Models\User;
use App\Models\Medium;
use App\Models\Tclass;
use App\Models\Subject;
use App\Models\Timely;
use App\Models\TutorInstituteType;
use App\Models\Weekly;
use App\Traits\FileCustomizeTrait;
use Illuminate\Validation\Rule;

class TuitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_result = $this->searching($request);
        $tuitions = Tuition::with('user', 'area')->where($search_result)->orderBy('id', 'DESC')->paginate(20);
        // dd($tuitions);
        return view('backend.tuition.index', compact('tuitions'));
    }

    private function searching($request)
    {
        $search_items = [];

        if ($request->job_id && $request->job_id != null) {
            $search_items[] = ['job_id', 'like', '%' . $request->job_id . '%'];
        }
        if ($request->name && $request->name != null) {
            $search_items[] = ['name', 'like', '%' . $request->name . '%'];
        }
        if ($request->phone && $request->phone != null) {
            $search_items[] = ['phone', 'like', '%' . $request->phone . '%'];
        }
        return $search_items;
    }

    public function searchByGuardianNumber(Request $request)
    {
        // dd($request);
        $phone = $request->input('phone');
        $guardians = User::where('user_type', 'guardian')->where('phone', $phone)->first();
        $tuitions = $guardians->tuitions()->paginate(15);


        // $tuition = Tuition::with('user', function ($query) use ($phone) {
        //     return $query->where('phone', $phone);
        // })->get();

        return view('backend.tuition.index', compact('guardians', 'tuitions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ini_set('memory_limit', '512M');
        $data['page_type'] = 'create';
        $data['divitions'] = Division::all();
        $data['districts'] = District::all();
        $data['mediums'] = Medium::all();
        $data['tclass'] = Tclass::all();
        $data['subjects'] = Subject::all();
        $data['timelys'] = Timely::all();
        $data['weeklys'] = Weekly::all();
        // $data['areas'] = Area::orderBy('name', 'asc')->get();
        $data['areas'] = Area::all();
        $tuitions = Tuition::select('name')->get();

        $data['users'] = User::where('status', '1')->where('user_type', 'student')->orwhere('user_type', 'guardian')->get();
        $posts = Tuition::get()->count();
        $code = $posts + 1;
        $post = Tuition::where('job_id', $code)->first();
        if ($post) {
            $code = $posts + 1;
        }
        return view('backend.tuition.create', $data, compact('code', 'tuitions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        $tuition = '';
        $request->validate([
            'action_type' => ['required', Rule::in(['edit', 'create'])]
        ]);


        if ($request->already_user == true) {
            $user = User::findOrFail($request->user_id);
        } else {

            $user = User::where('phone', $request->phone)->first();
            if ($user == null) {
                $this->validate($request, [
                    'phone' => ['required', Rule::unique('users', 'phone')]
                ]);

                if ($request->email == '') {
                    $request['email'] = $request->phone . "@mail.com";
                }
                if ($request->name == '') {
                    $request['name'] = "unknown";
                }
                if ($request->password == '') {
                    $request['password'] = "123456789";
                }

                $this->validate($request, [
                    'name' => 'required',
                    'phone' => 'required',
                    'email' => 'required|email|unique:users,email,',
                    'password' => 'required',
                    'user_type' => ['required', Rule::in(['guardian', 'student'])],
                ]);

                if ($request->action_type == 'edit') {
                    $user = User::findOrFail($request->user_id);
                } else {
                    $user = new User();
                }
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->whatsapp = $request->whatsapp;
                $user->password = $request->password;
                $user->status = $request->status;
                $user->user_type = $request->user_type;
                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');
                    $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path() . '/storages/tutor/';
                    $file->move($destinationPath, $fileName);
                    $user->avatar = '/storages/tutor/' . $fileName;
                }
                if ($request->hasFile('nid')) {
                    $file = $request->file('nid');
                    $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path() . '/storages/nid/';
                    $file->move($destinationPath, $fileName);
                    $user->nid = '/storages/nid/' . $fileName;
                }
                $user->save();
            }

            $guardian_student = GuardianStudent::where('user_id', $user->id)->first();
            if ($guardian_student == null) {
                $guardian_student = new GuardianStudent();
            }
            $guardian_student->user_id = $user->id;



            $area = Area::find($request->area_id);
            if ($area) {
                // $guardian_student->district_id = $area->district_id;
                $guardian_student->thana_id = $area->thana_id;
                $guardian_student->area_id = $area->id;
            }
            $guardian_student->save();
        }



        if ($request->action_type == 'edit') {
            $tuition = Tuition::findOrFail($request->tuition_id);
        } else {
            $tuition = new Tuition();
        }

        $tuition->user_id = $user->id;


        if ($request->area_id) {
            // $area = Area::with('district.division')->find($request->area_id);
            // if($area){
            // $tuition->district_id = $area->district_id;
            // $tuition->division_id = $area->district->division->id ?? '';
            // }
        }

        $tuition->area_id = $request->area_id;
        $tuition->address = $request->address;
        $tuition->gender = $request->gender;
        $tuition->tclass = $request->tclass;
        $tuition->phone = $request->phone;
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
        $tuition->tuition_category = $request->tuition_category;
        $tuition->status = $request->status;
        $tuition->class_type = $request->class_type;
        $tuition->tutor_faculty = $request->tutor_faculty;

        $tuition->salary_show_hide = $request->salary_show_hide;
        $tuition->details = $request->details;
        $tuition->note = $request->note;

        if ($request->action_type == 'create') {
            $job_id = $request->job_id;
            $post = Tuition::where('job_id', $job_id)->first();
            if ($post) {
                $posts = Tuition::get()->count();
                $job_id = $posts + 1;
            }
            $tuition->job_id = $job_id;
        }



        if (str_contains($request->salary, '-')) {
            $tuition->salary_range = $request->salary;
            $tuition->salary = null;
        } else {
            $tuition->salary = bn2en_only($request->salary);
            $tuition->salary_range = null;
        }


        if ($request->action_type == 'edit') {
            $tuition->update();
        } else {
            $tuition->save();
        }

        // $sms_text = 'OTP code to login-' . $user->temp_phone_otp;
        $sms_text = 'আপনার রিকয়ারমেন্টে thehometutor.net ওয়েবসাইটে ' . $job_id . ' নং টিউশন পোস্ট হয়েছে | সর্বোচ্চ ২৪ ঘন্টার মাঝে আপনাকে একজন যোগ্য টিউটর দেওয়া হবে, সে পর্যন্ত সাথেই থাকুন।
        Hotline: 09613-827678
        Whatsapp: 01601-346383';
        
        sendSms($user->phone, $sms_text);

        return redirect()->route('tuitions.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tuition  $tuition
     * @return \Illuminate\Http\Response
     */
    public function show(Tuition $tuition)
    {
        $data['divitions'] = Division::all();
        $data['districts'] = District::all();
        $data['areas'] = Area::all();
        $data['mediums'] = Medium::all();
        $data['tclass'] = Tclass::all();
        $data['subjects'] = Subject::all();
        $data['timelys'] = Timely::all();
        $data['weeklys'] = Weekly::all();
        $data['tuitionTemplate'] = TutorInstituteType::all();
        $data['users'] = User::where('status', '1')->where('user_type', 'student')->orwhere('user_type', 'guardian')->get();
        $tuition = Tuition::with('user')->findOrFail($tuition->id);

        return view('backend.tuition.show', $data, compact('tuition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tuition  $tuition
     * @return \Illuminate\Http\Response
     */
    public function edit(Tuition $tuition)
    {

        ini_set('memory_limit', '512M');
        $data['page_type'] = 'edit';
        $data['divitions'] = Division::all();
        $data['districts'] = District::all();
        $data['areas'] = Area::all();
        $data['mediums'] = Medium::all();
        $data['tclass'] = Tclass::all();
        $data['subjects'] = Subject::all();
        $data['timelys'] = Timely::all();
        $data['weeklys'] = Weekly::all();
        $data['tuitionTemplate'] = TutorInstituteType::all();
        $data['users'] = User::where('status', '1')->where('user_type', 'student')->orwhere('user_type', 'guardian')->get();
        $tuition = Tuition::findOrFail($tuition->id)->orderBy('id', 'DESC')->first();

        return view('backend.tuition.create', $data, compact('tuition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tuition  $tuition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tuition $tuition)
    {
        return redirect('/');

        //        $tuition = Tuition::findOrFail($tuition->id);
        //        if($request->already_user == true){
        //            $user = User::findOrFail($request->user_id);
        //        }else{
        //        $this->validate($request, [
        //            'name' => 'required',
        //            'phone' => 'required',
        //            'email' => 'required|email|unique:users,email,' . $tuition->user_id,
        //        ]);
        //        $user = User::findOrFail($tuition->user_id);
        //        $user->name = $request->name;
        //        $user->email = $request->email;
        //        $user->phone = $request->phone;
        //        if(!empty($request->password)){
        //            $user->password =$request->password;
        //        }
        //        $user->status =$request->status;
        //        $user->user_type =$request->user_type;
        //        if($request->hasFile('avatar')){
        //            FileCustomizeTrait::deleteFile($request->avatar);
        //            $file = $request->file('avatar') ;
        //            $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
        //            $destinationPath = public_path().'/storages/tutor/' ;
        //            $file->move($destinationPath,$fileName);
        //            $user->avatar = '/storages/tutor/'.$fileName;
        //        }
        //        if($request->hasFile('nid')){
        //            FileCustomizeTrait::deleteFile($request->nid);
        //            $file = $request->file('nid') ;
        //            $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
        //            $destinationPath = public_path().'/storages/nid/' ;
        //            $file->move($destinationPath,$fileName);
        //            $user->nid = '/storages/nid/'.$fileName;
        //        }
        //
        //        $user->save();
        //       }
        //        $tuition->user_id =$user->id;
        //        $tuition->division_id = $request->division_id;
        //        $tuition->district_id = $request->district_id;
        //        $tuition->area_id = $request->area_id;
        //        $tuition->address = $request->address;
        //        $tuition->gender = $request->gender;
        //        $tuition->tclass = $request->tclass;
        //        $tuition->phone = $request->contact_phone;
        //        $tuition->student_number = $request->student_number;
        //        $tuition->duration = $request->duration;
        //        $tuition->institution = $request->institution;
        //        $tuition->subject_ids = $request->subject_ids;
        //        $tuition->name = $request->title;
        //        $tuition->interest_medium = $request->interest_medium;
        //        $tuition->interest_class = $request->interest_class;
        //        $tuition->interest_gender = $request->interest_gender;
        //        $tuition->interest_sub = $request->interest_sub;
        //        $tuition->interest_time = $request->interest_time;
        //        $tuition->interest_institution = $request->interest_institution;
        //        $tuition->weekly = $request->weekly;
        //        $tuition->status = $request->status;
        //        $tuition->class_type = $request->class_type;
        //        $tuition->student_medium = $request->student_medium;
        //        $tuition->hiring_date = $request->hiring_date;
        //        $tuition->salary_show_hide = $request->salary_show_hide;
        //        $tuition->details = $request->details;
        //
        //        if (str_contains($request->salary, '-')) {
        //            $tuition->salary_range = $request->salary;
        //            $tuition->salary = null;
        //        }else{
        //            $tuition->salary = bn2en_only($request->salary);
        //            $tuition->salary_range = null;
        //        }
        //
        //        $tuition->save();
        //
        //        return redirect()->route('tuitions.index')
        //            ->with('success','User created successfully.');
    }
    public function status(Tuition $tuition)
    {
        if ($tuition->status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $tuition = Tuition::findOrFail($tuition->id);
        $tuition->status = $status;
        $tuition->save();
        return redirect()->route('tuitions.index')
            ->with('success', 'Tuition Status changes successfully.');
    }

    public function is_blocked_application(Request $request)
    {
        //    dd($request);
        $tuition = Tuition::findOrFail($request->tuition_id);
        $tuition->is_blocked_application = $request->is_blocked_application;
        $tuition->save();
        return redirect()->back()->with('success', 'Data Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tuition  $tuition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tuition $tuition)
    {
        // User::destroy($tutor->user_id);
        $tuition->delete();
        return redirect()->route('tuitions.index')
            ->with('success', 'Tuition deleted successfully.');
    }



    public function sent_email(Request $request)
    {
        return $request->all();
    }
}
