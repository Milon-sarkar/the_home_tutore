<?php

namespace App\Http\Controllers;

use App\Models\Timely;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TimelyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $timelies = Timely::All();
        return view('backend.timely.index',compact('timelies'));
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
        $timely = new Timely;
        $timely->name = $request->name;
        $timely->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timely $timely
     * @return \Illuminate\Http\Response
     */
    public function show(Timely $timely)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timely $timely
     * @return \Illuminate\Http\Response
     */
    public function edit(Timely $timely)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timely $timely
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timely $timely)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);
        $timely = Timely::findOrFail($timely->id);
        $timely->name = $request->name;
        $timely->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timely $timely
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timely $timely)
    {

        $data = Tutor::orWhereJsonContains('interest_sub',"{$timely->id}")->first();
        if(empty($data->id)){
            $timely->delete();
            return redirect()->back()->with('success', 'Data Deleted Successfully');
        }else{

            return redirect()->back()->with('error', 'Data Not Deleted');
        }

    }
}
