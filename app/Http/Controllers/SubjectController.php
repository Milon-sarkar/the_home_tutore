<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Tutor;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subjects = Subject::All();
        return view('backend.subject.index',compact('subjects'));
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
        $subject = new Subject;
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->code = $request->code;
        $subject->save();

        return redirect()->back()->with('success', 'Data Insert Successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);
        $subject = Subject::findOrFail($subject->id);
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->code = $request->code;
        $subject->save();

        return redirect()->back()->with('success', 'Data Updated Successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
       
        $data = Tutor::orWhereJsonContains('interest_sub',"{$subject->id}")->first();
        if(empty($data->id)){
            $subject->delete();
            return redirect()->back()->with('success', 'Data Deleted Successfully'); 
        }else{
            
        return redirect()->back()->with('error', 'Data Not Deleted'); 
        }
        
    }
}
