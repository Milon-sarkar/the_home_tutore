<?php

namespace App\Http\Controllers;

use App\Models\PremiumPackage;
use App\Models\PremiumPackageIteme;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PremiumPackageItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $premium_package_items = PremiumPackageIteme::All();
        return view('backend.premium_package.items',compact('premium_package_items'));
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
            'name'=>'required',
            'status'=> Rule::in(['1','2']),
        ]);
        $premium_package_item = new PremiumPackageIteme();
        $premium_package_item->name = $request->name;
        $premium_package_item->status = $request->status == '1' ? 1 : 0;
        $premium_package_item->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PremiumPackage $premium_package_item
     * @return \Illuminate\Http\Response
     */
    public function show(PremiumPackage $premium_package_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PremiumPackage $premium_package_item
     * @return \Illuminate\Http\Response
     */
    public function edit(PremiumPackage $premium_package_item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PremiumPackage $premium_package_item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PremiumPackageIteme $premium_package_item)
    {
        $this->validate($request, [
            'edit_name'=>'required',
            'edit_status'=> Rule::in(['1','2']),
        ]);
        $premium_package_item = PremiumPackageIteme::findOrFail($premium_package_item->id);
        $premium_package_item->name = $request->edit_name;
        $premium_package_item->status = $request->edit_status == '1' ? 1 : 0;
        $premium_package_item->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PremiumPackage $premium_package_item
     * @return \Illuminate\Http\Response
     */
    public function destroy(PremiumPackageIteme $premium_package_item)
    {

        $data = PremiumPackage::orWhereJsonContains('interest_sub',"{$premium_package_item->id}")->first();
        if(empty($data->id)){
            $premium_package_item->delete();
            return redirect()->back()->with('success', 'Data Deleted Successfully');
        }else{

            return redirect()->back()->with('error', 'Data Not Deleted');
        }

    }
}
