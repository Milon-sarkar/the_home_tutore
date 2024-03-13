<?php

namespace App\Http\Controllers;

use App\Models\TutorInstituteType;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorInstituteTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tutor_faculties = TutorInstituteType::All();
        return view('backend.tutor_institute_type.index',compact('tutor_faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);
        $tutor_institute_type = new TutorInstituteType;
        $tutor_institute_type->name = $request->name;
        $tutor_institute_type->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TutorInstituteType  $tutor_institute_type
     * @return \Illuminate\Http\Response
     */
    public function show(TutorInstituteType $tutor_institute_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TutorInstituteType  $tutor_institute_type
     * @return \Illuminate\Http\Response
     */
    public function edit(TutorInstituteType $tutor_institute_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TutorInstituteType  $tutor_institute_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TutorInstituteType $tutor_institute_type)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);
        $tutor_institute_type = TutorInstituteType::findOrFail($tutor_institute_type->id);
        $tutor_institute_type->name = $request->name;
        $tutor_institute_type->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TutorInstituteType  $tutor_institute_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(TutorInstituteType $tutor_institute_type)
    {

        $tutor_institute_type->delete();
        return redirect()->back()->with('success', 'Data Deleted Successfully');

    }
}
