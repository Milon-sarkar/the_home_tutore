<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\Tutor;
use Illuminate\Http\Request;

class SubscriberListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subscriber_lists = Subscriber::All();
        return view('backend.subscriber_list.index',compact('subscriber_lists'));
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
            'email'=>'required|email'
        ]);
        $subscriber_list = new Subscriber;
        $subscriber_list->email = $request->email;
        $subscriber_list->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscriber  $subscriber_list
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber_list)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscriber  $subscriber_list
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber_list)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscriber  $subscriber_list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber_list)
    {
        $this->validate($request, [
            'edit_email'=>'required|email'
        ]);
        $subscriber_list = Subscriber::findOrFail($subscriber_list->id);
        $subscriber_list->email = $request->edit_email;
        $subscriber_list->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriber  $subscriber_list
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber_list)
    {

        $subscriber_list->delete();
        return redirect()->back()->with('success', 'Data Deleted Successfully');

    }
}
