<?php

namespace App\Http\Controllers;

use App\Models\Medium;
use App\Models\Tutor;
use Illuminate\Http\Request;

class MediumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mediums = Medium::All();
        return view('backend.medium.index',compact('mediums'));
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
        $medium = new Medium;
        $medium->name = $request->name;
        $medium->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medium $medium
     * @return \Illuminate\Http\Response
     */
    public function show(Medium $medium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medium $medium
     * @return \Illuminate\Http\Response
     */
    public function edit(Medium $medium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medium $medium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medium $medium)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);
        $medium = Medium::findOrFail($medium->id);
        $medium->name = $request->name;
        $medium->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medium $medium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medium $medium)
    {

        $data = Tutor::orWhereJsonContains('interest_sub',"{$medium->id}")->first();
        if(empty($data->id)){
            $medium->delete();
            return redirect()->back()->with('success', 'Data Deleted Successfully');
        }else{

            return redirect()->back()->with('error', 'Data Not Deleted');
        }

    }
}
