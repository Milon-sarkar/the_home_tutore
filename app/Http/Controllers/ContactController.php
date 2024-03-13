<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_result = $this->form_search($request);

        $data = Contact::where($search_result)->orderby('created_at','DESC');
        $data = $data->paginate(10);
        return view('backend.contact.contact_list',compact('data'));
    }
    private function form_search($request){
        $search_items = [];

        if ($request->created_at){
            $search_items[] = ['created_at', 'like', '%' . $request->created_at . '%'];
        }
        if ($request->name){
            $search_items[] = ['name', 'like', '%' . $request->name . '%'];
        }
        if ($request->email){
            $search_items[] = ['email', 'like', '%' . $request->email . '%'];
        }
        if ($request->phone){
            $search_items[] = ['phone', 'like', '%' . $request->phone . '%'];
        }

        if ($request->message){
            $search_items[] = ['message', 'like', '%' . $request->message . '%'];
        }

        return $search_items;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function contact_delete($id)
    {
        Contact::where('id', $id)->delete();
        return redirect()->route('contact.index')->with('success','Deleted Sucessfully');
    }

    public function destroy($id)
    {
        Contact::where('id', $id)->where('status', 'apply')->delete();
        return redirect()->route('contact.index')->with('success','Deleted Sucessfully');
    }
}
