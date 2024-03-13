<?php

namespace App\Http\Controllers;

use App\Models\NotificationTemplate ;
use App\Models\Tutor;
use Illuminate\Http\Request;

class NotificationTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $notification_templates = NotificationTemplate ::All();
        return view('backend.notification_template.index',compact('notification_templates'));
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
        $notification_template = new NotificationTemplate ;
        $notification_template->title = $request->title;
        $notification_template->body = $request->body;
        $notification_template->created_by = auth()->id();
        $notification_template->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotificationTemplate $notification_template
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationTemplate $notification_template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotificationTemplate $notification_template
     * @return \Illuminate\Http\Response
     */
    public function edit(NotificationTemplate $notification_template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotificationTemplate $notification_template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationTemplate $notification_template)
    {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required', 'max: 150'
        ]);
        $notification_template = NotificationTemplate ::findOrFail($notification_template->id);
        $notification_template->title = $request->title;
        $notification_template->body = $request->body;
        $notification_template->created_by = auth()->id();
        $notification_template->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotificationTemplate $notification_template
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationTemplate $notification_template)
    {
        $notification_template->delete();

        return redirect()->back()->with('error', 'Data Not Deleted');
    }
}
