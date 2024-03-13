<?php

namespace App\Http\Controllers;

use App\Models\TuitionConditionTemplate ;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TuitionConditionTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tuition_conditions = TuitionConditionTemplate ::All();
        return view('backend.tuition_condition.index',compact('tuition_conditions'));
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
            'title'=>'required',
            'body'=>'required', 'max: 150'
        ]);
        $tuition_condition = new TuitionConditionTemplate ;
        $tuition_condition->title = $request->title;
        $tuition_condition->body = $request->body;
        $tuition_condition->created_by = auth()->id();
        $tuition_condition->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TuitionConditionTemplate $tuition_condition
     * @return \Illuminate\Http\Response
     */
    public function show(TuitionConditionTemplate $tuition_condition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TuitionConditionTemplate $tuition_condition
     * @return \Illuminate\Http\Response
     */
    public function edit(TuitionConditionTemplate $tuition_condition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TuitionConditionTemplate $tuition_condition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TuitionConditionTemplate $tuition_condition)
    {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required', 'max: 150'
        ]);
        $tuition_condition = TuitionConditionTemplate ::findOrFail($request->tuition_condition_id);
        $tuition_condition->title = $request->title;
        $tuition_condition->body = $request->body;
        $tuition_condition->created_by = auth()->id();
        $tuition_condition->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TuitionConditionTemplate $tuition_condition
     * @return \Illuminate\Http\Response
     */
    public function destroy(TuitionConditionTemplate $tuition_condition)
    {

        $tuition_condition->delete();
        return redirect()->back()->with('error', 'Data Not Deleted');

    }
}
