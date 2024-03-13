<?php

namespace App\Http\Controllers;

use App\Models\Weekly;
use App\Models\Tutor;
use Illuminate\Http\Request;

class WeeklyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $weeklies = Weekly::All();
        return view('backend.weekly.index',compact('weeklies'));
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
        $weekly = new Weekly;
        $weekly->name = $request->name;
        $weekly->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Weekly $weekly
     * @return \Illuminate\Http\Response
     */
    public function show(Weekly $weekly)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Weekly $weekly
     * @return \Illuminate\Http\Response
     */
    public function edit(Weekly $weekly)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Weekly $weekly
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weekly $weekly)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);
        $weekly = Weekly::findOrFail($weekly->id);
        $weekly->name = $request->name;
        $weekly->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weekly $weekly
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weekly $weekly)
    {

        $data = Tutor::orWhereJsonContains('interest_sub',"{$weekly->id}")->first();
        if(empty($data->id)){
            $weekly->delete();
            return redirect()->back()->with('success', 'Data Deleted Successfully');
        }else{

            return redirect()->back()->with('error', 'Data Not Deleted');
        }

    }
}
