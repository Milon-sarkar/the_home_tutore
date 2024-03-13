<?php

namespace App\Http\Controllers;

use App\Models\TutorFaculty;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorFacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tutor_faculties = TutorFaculty::All();
        return view('backend.tutor_faculty.index',compact('tutor_faculties'));
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
        $tutor_faculty = new TutorFaculty;
        $tutor_faculty->name = $request->name;
        $tutor_faculty->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TutorFaculty  $tutor_faculty
     * @return \Illuminate\Http\Response
     */
    public function show(TutorFaculty $tutor_faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TutorFaculty  $tutor_faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(TutorFaculty $tutor_faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TutorFaculty  $tutor_faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TutorFaculty $tutor_faculty)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);
        $tutor_faculty = TutorFaculty::findOrFail($tutor_faculty->id);
        $tutor_faculty->name = $request->name;
        $tutor_faculty->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TutorFaculty  $tutor_faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(TutorFaculty $tutor_faculty)
    {

        $tutor_faculty->delete();
        return redirect()->back()->with('success', 'Data Deleted Successfully');

    }
}
