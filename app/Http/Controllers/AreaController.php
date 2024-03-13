<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\District;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $areas = Area::orderBy('id', 'DESC')->paginate(50);
        $districts = District::all();
        return view('backend.area.index',compact('areas','districts'));
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
            'district_id'=> ['required',Rule::exists('districts','id')],
            'thana_id'=> ['required',Rule::exists('thanas','id')],
            'name'=> ['required',Rule::unique('areas','name')->where(function($q) use($request){
                $q->where('district_id', '=', $request->district_id);
                $q->where('thana_id', '=', $request->thana_id);
            })],
        ]);
        $area = new Area;
        $area->district_id = $request->district_id;
        $area->thana_id = $request->thana_id;
        $area->name = $request->name;
        $area->bn_name = $request->bn_name;
        $area->status = $request->status;
        $area->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $this->validate($request, [
            'area_id'=> ['required',Rule::exists('areas','id')],
            'district_id'=> ['required',Rule::exists('districts','id')],
            'thana_id'=> ['required',Rule::exists('thanas','id')],
            'name'=> ['required',Rule::unique('areas','name')->where(function($q) use($request){
                $q->where('district_id', '=', $request->district_id);
                $q->where('thana_id', '=', $request->thana_id);
            })->ignore($request->area_id)],
        ]);

        $area = Area::findOrFail($area->id);
        $area->district_id = $request->district_id;
        $area->thana_id = $request->thana_id;
        $area->name = $request->name;
        $area->status = $request->status;
        $area->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {

        $data = Tutor::orWhereJsonContains('interest_sub',"{$area->id}")->first();
        if(empty($data->id)){
            $area->delete();
            return redirect()->back()->with('success', 'Data Deleted Successfully');
        }else{

        return redirect()->back()->with('error', 'Data Not Deleted');
        }

    }
}
