<?php

namespace App\Http\Controllers;

use App\Models\SmsTemplate ;
use App\Models\Tutor;
use Illuminate\Http\Request;

class SmsTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sms_templates = SmsTemplate ::All();
        return view('backend.sms_template.index',compact('sms_templates'));
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
        $sms_template = new SmsTemplate ;
        $sms_template->title = $request->title;
        $sms_template->type = $request->type;
        $sms_template->body = $request->body;
        $sms_template->created_by = auth()->id();
        $sms_template->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmsTemplate $sms_template
     * @return \Illuminate\Http\Response
     */
    public function show(SmsTemplate $sms_template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SmsTemplate $sms_template
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsTemplate $sms_template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SmsTemplate $sms_template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmsTemplate $sms_template)
    {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required', 'max: 150'
        ]);
        $sms_template = SmsTemplate ::findOrFail($sms_template->id);
        $sms_template->title = $request->title;
        $sms_template->type = $request->type;
        $sms_template->body = $request->body;
        $sms_template->created_by = auth()->id();
        $sms_template->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmsTemplate $sms_template
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsTemplate $sms_template)
    {

        $sms_template->delete();
        return redirect()->back()->with('error', 'Data Not Deleted');

    }
}
