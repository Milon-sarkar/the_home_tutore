<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\GuardianStudent;
use App\Models\Setting;
use App\Models\Tuition;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Traits\FileCustomizeTrait;
use Illuminate\Validation\Rule;

class GuardianStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

         if($request->type && $request->type != ''){
            if($request->type == 'student'){
                $type = 'student';
            }else{
                $type = 'guardian';
            }
            $search_value = $this->simple_search($request);

            $users = User::select('users.*', 'guardian_students.user_id', 'guardian_students.district_id', 'guardian_students.thana_id', 'guardian_students.area_id')
                    ->leftJoin('guardian_students', 'guardian_students.user_id', '=', 'users.id')
                    ->where($search_value)->where('users.user_type', $type)->orderBy('users.id', 'DESC')->paginate(30);

            return view('backend.guardian_or_student.index', compact(['users','request', 'type']));

        }
        return abort('404');

    }


    private function simple_search($request){
        $search_items = [];

        if($request->form_search && $request->form_search == 'search_submitted'){

            if ($request->name){
                $search_items[] = ['users.name', 'like', '%'.$request->name.'%'];
            }
            if ($request->phone){
                $search_items[] = ['users.phone', $request->phone];
            }
            if ($request->email){
                $search_items[] = ['users.email', $request->email];
            }
            if ($request->district_id){
                $search_items[] = ['guardian_students.district_id', $request->district_id];
            }
            if ($request->thana_id){
                $search_items[] = ['guardian_students.thana_id', $request->thana_id];
            }
            if ($request->area_id){
                $search_items[] = ['guardian_students.area_id', $request->area_id];
            }

//            if ($request->status){
//                if($request->status == 1){
//                    $search_items[] = ['users.status', '1'];
//                }else if($request->status == 0){
//                    $search_items[] = ['users.status', '0'];
//                }
//            }

        }

        return $search_items;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $page_type = 'create';
        if($request->type && $request->type != '') {
            if ($request->type == 'student') {
                $type = 'student';
            } else {
                $type = 'guardian';
            }

            return view('backend.guardian_or_student.create', compact('type', 'page_type'));
        }
        return abort('404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $request->type;
        if($request->action_type == 'create'){
            $request['password'] = '123456789';

            $this->validate($request, [
                'phone' => 'required',
                'email' => 'nullable|email|unique:users,email',
                'type' => ['required',Rule::in('guardian', 'student')],
            ]);
        }else{
            $this->validate($request, [
                'phone' => ['required', Rule::unique('users', 'phone')->ignore($request->user_id)],
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($request->user_id)],
                'type' => ['required',Rule::in('guardian', 'student')],
            ]);
        }

        if($request->action_type == 'create'){
            $user = new User();
        }else{
            $user = User::findOrFail($request->user_id);
        }

        $user->name = $request->name ?? 'unknown';
        $user->email = $request->email ?? $request->phone."@mail.com";
        $user->phone = $request->phone;
        $user->status =$request->status;
        if($request->action_type == 'create'){
            $user->password = $request->password;
        }
        $user->user_type = $type;
        $user->save();

        $area = Area::where('name', $request['area_name'])->where('district_id', $request['district_id'])->where('thana_id', $request['thana_id'])->first();
        if ($area == null) {
            $area = new Area();
            $area->district_id = $request['district_id'];
            $area->thana_id = $request['thana_id'];
            $area->name = $request['area_name'];
            $area->save();
        }

        if($request->action_type == 'create'){
            $guardian_student = new GuardianStudent();
        }else{
            $guardian_student = GuardianStudent::where('user_id',$user->id)->first();
        }
        $guardian_student->user_id = $user->id;
        $guardian_student->district_id = $request->district_id;
        $guardian_student->thana_id = $request->thana_id;
        $guardian_student->area_id = $area->id;
        $guardian_student->save();


        return redirect('/admin/guardian_or_student?type='.$type)->with('success',$type.' created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->user_id;

        if($request->type && $request->type != '') {
            if ($request->type == 'student') {
                $type = 'student';
            } else {
                $type = 'guardian';
            }
//            $user = User::with('tuitions')->findOrFail($id);
            $user = User::findOrFail($id);
            if (!$user) {
                return abort(404);
            }


            return view('backend.guardian_or_student.show', compact(['user','type']));
        }
        return abort('404');
    }


    public function status(Request $request)
    {
        if($request->type && $request->type != '') {
            if ($request->type == 'student') {
                $type = 'student';
            } else {
                $type = 'guardian';
            }
            $user = User::findOrFail($request->user_id);
            if ($user->status == 0) {
                $status = 1;
            } else {
                $status = 0;
            }
            $user->status = $status;
            $user->save();
            return redirect('/admin/guardian_or_student?type='.$type)->with('success', 'User Status changes successfully.');
        }
        return abort('404');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */



    public function edit(Request $request)
    {
        $page_type = 'edit';
        if($request->type && $request->type != '') {
            if ($request->type == 'student') {
                $type = 'student';
            } else {
                $type = 'guardian';
            }

            $type = $request->type;
            $user = User::where('user_type', $type)->findOrFail($request->user_id);
            return view('backend.guardian_or_student.create', compact('user','type', 'page_type'));
        }
        return abort('404');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user_type = $user->user_type;
        if(!empty($user)){
            $user->delete();
            return redirect()->route('guardian_or_student.index')
                ->with('success',$user_type.' deleted successfully.');
        }else{
         return redirect()->back()->with('error', 'Data Not Deleted');
        }
    }
}
