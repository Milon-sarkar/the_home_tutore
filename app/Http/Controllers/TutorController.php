<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Setting;
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
use App\Models\Weekly;
use App\Models\PremiumPackage;
use App\Models\TuitionBook;
use Illuminate\Http\Request;
use App\Traits\FileCustomizeTrait;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->form_search AND $request->form_search == 'search_submitted'){
            $search_value = $this->tutor_search($request);
        }else{
            $search_value = [];
        }
         if($request->total_rows AND $request->total_rows != '' AND $request->total_rows != 'default' AND $request->total_rows != 'all'){
            $paginate = $request->total_rows;
        }elseif ($request->total_rows == 'all'){
             $paginate = 8000;
         }else{
            $paginate = 50;
        }

         if(isset($request->status)){
             if($request->status == 'active'){
                 $default_status = '1';
             }elseif ($request->status == 'inactive'){
                 $default_status = '0';
             }
         }else{
             $default_status = "1";
         }


        $divisions = Division::get();
        $subjects = Subject::orderBy('name','ASC')->get();
        $tclasses = Tclass::orderBy('name','ASC')->get();
        $mediums = Medium::orderBy('name','ASC')->get();
        //  dd($mediums);
        $timelys = Timely::orderBy('name','ASC')->get();
        $weeklys = Weekly::orderBy('name','ASC')->get();
        $areas = Area::orderBy('name','ASC')->get();


        if($request->form_search AND $request->form_search == 'find_tutor') {
            $tutors = Tutor::with('district','user')
                ->orderBy('id', 'DESC')
                ->where('status', $default_status)
                ->where('institution', 'like', '%'.$request->interest_institution.'%')
                ->where('faculty', 'like', '%'.$request->tutor_faculty.'%')
                ->where(function($q) use($request){
                        if(json_decode($request->interest_medium)){
                            foreach (json_decode($request->interest_medium) as $int_medium){
                                $q->OrwhereJsonContains('interest_medium', "{$int_medium}");
                            }
                            foreach (json_decode($request->interest_medium) as $int_medium){
                                $q->where('ssc_medium', "{$int_medium}");
                            }
                            foreach (json_decode($request->interest_medium) as $int_medium){
                                $q->where('hsc_medium', "{$int_medium}");
                            }
                        }
                })
                ->where(function($q) use($request){
                        if(json_decode($request->interest_sub)){
                            foreach (json_decode($request->interest_sub) as $int_sub){
                                $q->OrwhereJsonContains('interest_sub', "{$int_sub}");
                            }
                        }
                })
                ->whereIn('gender', json_decode($request->interest_gender) ?? ['male','female'])
                ->latest()
                ->paginate(30);

        }else{

            $tutors = Tutor::select("tutors.*","users.name","users.phone")
                                ->leftJoin('users', 'users.id', '=', 'tutors.user_id')
                                ->where('tutors.status', $default_status)->where($search_value)->orderBy('tutors.id', 'DESC')->latest()->paginate($paginate);
        }
        //  dd($mediums);
        return view('backend.tutors.index', compact(['tutors','divisions','subjects','tclasses','mediums','timelys','weeklys','request','areas']));
    }




    private function tutor_search($request){
        $search_items = [];

        if($request->form_search && $request->form_search == 'search_submitted'){
            if ($request->tutor_code && $request->tutor_code != null){
                $search_items[] = ['tutors.tutor_code',  $request->tutor_code];
            }
            if ($request->division_id && $request->division_id != null){
                $search_items[] = ['tutors.division_id', $request->division_id];
            }
            if ($request->district_id && $request->district_id != null){
                $search_items[] = ['tutors.district_id', $request->district_id];
            }
            if ($request->permanent_district_id && $request->permanent_district_id != null){
                $search_items[] = ['tutors.permanent_district_id', $request->permanent_district_id];
            }
            if ($request->thana_id && $request->thana_id != null){
                $search_items[] = ['tutors.thana_id', $request->thana_id];
            }
            if ($request->area_id && $request->area_id != null){
                $search_items[] = ['area_id', $request->area_id];
            }
            if ($request->tutor_gender && $request->tutor_gender != null){
                $search_items[] = ['tutors.gender', $request->tutor_gender];
            }
            if ($request->tutor_institution && $request->tutor_institution != null){
                $search_items[] = ['tutors.institution','like', '%'.$request->tutor_institution.'%'];
            }
            if ($request->faculty && $request->faculty != null){
                $search_items[] = ['tutors.faculty','like', '%'.$request->faculty.'%'];
            }
            if ($request->tutor_subject_name && $request->tutor_subject_name != null){
                $search_items[] = ['tutors.subject_name','like', '%'.$request->tutor_subject_name.'%'];
            }
            if ($request->tutor_name && $request->tutor_name != null){
                $search_items[] = ['users.name', $request->tutor_name];
            }
            if ($request->tutor_phone && $request->tutor_phone != null){
                $search_items[] = ['users.phone', $request->tutor_phone];
            }

            if ($request->tutor_salary && $request->tutor_salary != null) {
                $tutor_salary_type = '=';

                if($tutor_salary_type == 'Negotiable'){
                    $search_items[] = ['tutors.salary', 'Negotiable'];
                }else{
                    switch ($request->tutor_salary_type) {
                        case '<':
                            $tutor_salary_type = '<';
                            break;
                        case '>':
                            $tutor_salary_type = '>';
                            break;
                    }
                    $search_items[] = ['tutors.salary', $tutor_salary_type, $request->tutor_salary];
                }
            }

            if ($request->top && $request->top != null){
                if($request->top == 1){
                    $search_items[] = ['tutors.top', 1];
                }else{
                    $search_items[] = ['tutors.top', 0];
                }
            }

//            if (isset($request->status)){
//                if($request->status == 'active'){
//                    $search_items[] = ['status', '1'];
//                }else{
//                    $search_items[] = ['status', '0'];
//                }
//            }


            if ($request->interested_subject_id && $request->interested_subject_id != null){
                $search_items[] = ['tutors.interest_sub',  'like', '%'.$request->interested_subject_id.'%'];
            }
            if ($request->interested_class_id && $request->interested_class_id != null){
                $search_items[] = ['tutors.interest_class', 'like', '%'. $request->interested_class_id.'%'];
            }
            if ($request->interested_medium_id && $request->interested_medium_id != null){
                $search_items[] = ['tutors.interest_medium', 'like', '%'.$request->interested_medium_id.'%'];
            }
            if ($request->medium_id && $request->medium_id != null){
                $search_items[] = ['tutors.interest_medium', 'like', '%'.$request->medium_id.'%'];
            }
            if ($request->interested_time_id && $request->interested_time_id != null){
                $search_items[] = ['tutors.interest_time', 'like', '%'. $request->interested_time_id.'%'];
            }
            if ($request->interested_week_id && $request->interested_week_id != null){
                $search_items[] = ['tutors.weekly', 'like', '%'. $request->interested_week_id.'%'];
            }

        }

        return $search_items;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['divitions'] =Division::all();
        $data['districts'] =District::all();
        $data['areas'] =Area::all();
        $data['mediums'] =Medium::all();
        $data['tclass'] =Tclass::all();
        $data['subjects'] =Subject::all();
        $data['timelys'] =Timely::all();
        $data['weeklys'] =Weekly::all();
        $data['packages'] =PremiumPackage::all();


        $tutors = Tutor::get()->count();
        $tutor_code = "ID". str_pad($tutors +1, 4, "0", STR_PAD_LEFT);
        return view('backend.tutors.create',$data, compact('tutor_code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,',
            'password' => 'required',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password =$request->password;
        $user->status =$request->status;
        if($request->hasFile('avatar')){
            $file = $request->file('avatar') ;
            $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
            $destinationPath = public_path().'/storages/tutor/' ;
            $file->move($destinationPath,$fileName);
            $user->avatar = '/storages/tutor/'.$fileName;
        }
        if($request->hasFile('nid')){
            $file = $request->file('nid') ;
            $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
            $destinationPath = public_path().'/storages/nid/' ;
            $file->move($destinationPath,$fileName);
            $user->nid = '/storages/nid/'.$fileName;
        }

        $user->save();
        $tutor = new Tutor;
        $tutor->user_id =$user->id;
        $tutor->division_id = $request->division_id;
        $tutor->district_id = $request->district_id;
        $tutor->area_id = $request->area_id;
        $tutor->address = $request->address;
        $tutor->gender = $request->gender;
        $tutor->date_of_birth = $request->date_of_birth;
        $tutor->institution = $request->institution;
        $tutor->subject_id = $request->subject_id;
        $tutor->facebook_link = $request->facebook_link;
        $tutor->interest_location = $request->interest_location;
        $tutor->interest_medium = $request->interest_medium;
        $tutor->interest_class =$request->interest_class;
        $tutor->interest_gender = $request->interest_gender;
        $tutor->interest_sub = $request->interest_sub;
        $tutor->interest_time = $request->interest_time;
        $tutor->weekly = $request->weekly;
        $tutor->status = $request->status;
        $tutor->member_type = $request->member_type;
        $tutors = Tutor::get()->count();
        $tutor_code = "ID". str_pad($tutors +1, 4, "0", STR_PAD_LEFT);
        $tutor->tutor_code = $tutor_code;
        $tutor->salary = $request->salary;
        $tutor->save();

        return redirect()->route('tutors.index')
            ->with('success','User created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['areas'] =Area::all();
        $data['mediums'] =Medium::all();
        $data['tclass'] =Tclass::all();
        $data['subjects'] =Subject::all();
        $data['timelys'] =Timely::all();
        $data['weeklys'] =Weekly::all();
        $data['tuition_all'] = TuitionBook::where('tutor_id', $id)->orderBy('id','desc')->get();

        $tutor = Tutor::with('book_tuitions')->find($id);
        // if(!$tutor){
        //     return abort(404);
        // }

        return view('backend.tutors.show', $data, compact(['tutor']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function print($id, Request $request)
    {
        $data['areas'] =Area::all();
        $data['mediums'] =Medium::all();
        $data['tclass'] =Tclass::all();
        $data['subjects'] =Subject::all();
        $data['timelys'] =Timely::all();
        $data['weeklys'] =Weekly::all();
        $data['urgency'] = null;

        if($request->tuition_id){
            $data['urgency'] = TuitionBook::where('tutor_id', $id)->where('tuition_id', $request->tuition_id)->first()['tutor_urgency'];
        }

        $tutor = Tutor::with('book_tuitions')->find($id);
        if(!$tutor){
            return abort(404);
        }

        return view('backend.tutors.print', $data, compact(['tutor']));
    }


    public function status(Tutor $tutor)
    {
        if($tutor->status ==0){
            $status = 1;
        }else{
            $status = 0;
        }
        $tutor = Tutor::with('user')->findOrFail($tutor->id);
        $tutor->status = $status;
        $tutor->save();
        $sms_body = 'Your account is active now. Please login. The Home Tutor';
        if($tutor->user){
            sendSms($tutor->user->phone, $sms_body);
        }
        return redirect()->route('tutors.index')
        ->with('success','Tutor Status changes successfully.');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutor $tutor)
    {
        // dd($tutor);
        $data['divitions'] =Division::all();
        $data['districts'] =District::all();
        $data['areas'] =Area::all();
        $data['mediums'] =Medium::all();
        $data['tclass'] =Tclass::all();
        $data['subjects'] =Subject::all();
        $data['timelys'] =Timely::all();
        $data['weeklys'] =Weekly::all();
        $data['packages'] =PremiumPackage::all();
        $tutor = Tutor::findOrFail($tutor->id);
        return view('backend.tutors.edit',$data,compact('tutor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutor $tutor)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,' . $tutor->user_id,
        ]);

        $user = User::findOrFail($tutor->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if(!empty($request->password)){
            $user->password =$request->password;
        }
        $user->status =$request->status;
        if($request->hasFile('avatar')){
            FileCustomizeTrait::deleteFile($request->avatar);
            $file = $request->file('avatar') ;
            $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
            $destinationPath = public_path().'/storages/tutor/' ;
            $file->move($destinationPath,$fileName);
            $user->avatar = '/storages/tutor/'.$fileName;
        }
        if($request->hasFile('nid')){
            FileCustomizeTrait::deleteFile($request->nid);
            $file = $request->file('nid') ;
            $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
            $destinationPath = public_path().'/storages/nid/' ;
            $file->move($destinationPath,$fileName);
            $user->nid = '/storages/nid/'.$fileName;
        }
        $user->user_type ='tutor';
        $user->save();
        $tutor = Tutor ::findOrFail($tutor->id);
        $tutor->user_id =$user->id;
        $tutor->division_id = $request->division_id;
        $tutor->permanent_district_id = $request->permanent_district_id;
        $tutor->district_id = $request->district_id;
        $tutor->area_id = $request->area_id;
        $tutor->address = $request->address;
        $tutor->gender = $request->gender;
        $tutor->date_of_birth = $request->date_of_birth;
        $tutor->institution = $request->institution;
        $tutor->subject_id = $request->subject_id;
        $tutor->facebook_link = $request->facebook_link;
        $tutor->interest_location = $request->interest_location;
        $tutor->interest_medium = $request->interest_medium;
        $tutor->interest_class = $request->interest_class;
        $tutor->interest_gender = $request->interest_gender;
        $tutor->interest_sub = $request->interest_sub;
        $tutor->interest_time = $request->interest_time;
        $tutor->weekly = $request->weekly;
        $tutor->status = $request->status;
        $tutor->member_type = $request->member_type;
        //dd($tutor);
        $tutor->salary = $request->salary;
        $tutor->hsc_institute = $request->hsc_institute;
        $tutor->hsc_result = $request->hsc_result;
        $tutor->ssc_institute = $request->ssc_institute;
        $tutor->ssc_result = $request->ssc_result;
        $tutor->interest_medium = $request->interest_medium;
        $tutor->save();

        return redirect()->route('tutors.index')
            ->with('success','Tutor Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutor $tutor)
    {
        $data = TuitionBook::where('tutor_id',$tutor->id)->first();
        if(empty($data->id)){
            $tutor->delete();
            return redirect()->route('tutors.index')
                ->with('success','Tutor deleted successfully.');
        }else{
         return redirect()->back()->with('error', 'Data Not Deleted');
        }
    }
}
