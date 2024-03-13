<?php

namespace App\Http\Controllers;

use App\Models\PremiumPackage;
use App\Models\PremiumPackageIteme;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PremiumPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $premium_packages = PremiumPackage::get();
        $premium_package_items = PremiumPackageIteme::get();
        return view('backend.premium_package.index',compact(['premium_packages','premium_package_items']));
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
            'duration'=>'numeric',
            'price'=>'numeric',
            'status'=> Rule::in(['1','2']),
            'description' => 'nullable|max:120'
        ]);


        $premium_package = new PremiumPackage;
        $premium_package->title = $request->name;
        $premium_package->description = $request->description;
        $premium_package->duration = $request->duration;
        $premium_package->price = $request->price;
        $premium_package->status = $request->status == '1' ? 1 : 0;
        $premium_package->selected_items = json_encode($request->items);
        $premium_package->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PremiumPackage $premium_package
     * @return \Illuminate\Http\Response
     */
    public function show(PremiumPackage $premium_package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PremiumPackage $premium_package
     * @return \Illuminate\Http\Response
     */
    public function edit(PremiumPackage $premium_package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PremiumPackage $premium_package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PremiumPackage $premium_package)
    {
        $this->validate($request, [
            'edit_title'=>'required',
            'edit_price'=>'numeric',
            'edit_duration'=>'numeric',
            'edit_status'=> Rule::in(['1','2']),
            'edit_description' => 'nullable|max:120'
        ]);
        $premium_package = PremiumPackage::findOrFail($premium_package->id);
        $premium_package->title = $request->edit_title;
        $premium_package->description = $request->edit_description;
        $premium_package->duration = $request->edit_duration;
        $premium_package->price = $request->edit_price;
        $premium_package->status = $request->edit_status == '1' ? 1 : 0;
        $premium_package->selected_items = json_encode($request->items);
        $premium_package->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PremiumPackage $premium_package
     * @return \Illuminate\Http\Response
     */
    public function destroy(PremiumPackage $premium_package)
    {

        $data = Tutor::orWhereJsonContains('interest_sub',"{$premium_package->id}")->first();
        if(empty($data->id)){
            $premium_package->delete();
            return redirect()->back()->with('success', 'Data Deleted Successfully');
        }else{

            return redirect()->back()->with('error', 'Data Not Deleted');
        }

    }
}
