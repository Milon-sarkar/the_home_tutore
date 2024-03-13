<?php

namespace App\Http\Controllers;

use App\Models\Tclass;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $classes = Tclass::All();
        return view('backend.class.index',compact('classes'));
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
        $class = new Tclass;
        $class->name = $request->name;
        $class->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tclass $class
     * @return \Illuminate\Http\Response
     */
    public function show(Tclass $class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tclass $class
     * @return \Illuminate\Http\Response
     */
    public function edit(Tclass $class)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tclass $class
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tclass $class)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);
        $class = Tclass::findOrFail($class->id);
        $class->name = $request->name;
        $class->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tclass $class
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tclass $class)
    {

        $data = Tutor::orWhereJsonContains('interest_sub',"{$class->id}")->first();
        if(empty($data->id)){
            $class->delete();
            return redirect()->back()->with('success', 'Data Deleted Successfully');
        }else{

            return redirect()->back()->with('error', 'Data Not Deleted');
        }

    }
}
