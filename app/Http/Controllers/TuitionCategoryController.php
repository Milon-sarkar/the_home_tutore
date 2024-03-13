<?php

namespace App\Http\Controllers;

use App\Models\TuitionCategory;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TuitionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tuition_categories = TuitionCategory::All();
        return view('backend.tuition_category.index',compact('tuition_categories'));
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
        $tuition_category = new TuitionCategory;
        $tuition_category->name = $request->name;
        $tuition_category->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TuitionCategory  $tuition_category
     * @return \Illuminate\Http\Response
     */
    public function show(TuitionCategory $tuition_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TuitionCategory  $tuition_category
     * @return \Illuminate\Http\Response
     */
    public function edit(TuitionCategory $tuition_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TuitionCategory  $tuition_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TuitionCategory $tuition_category)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);
        $tuition_category = TuitionCategory::findOrFail($tuition_category->id);
        $tuition_category->name = $request->name;
        $tuition_category->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TuitionCategory  $tuition_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(TuitionCategory $tuition_category)
    {

        $tuition_category->delete();
        return redirect()->back()->with('success', 'Data Deleted Successfully');

    }
}
