<?php

namespace App\Http\Controllers;

use App\Models\TitleTemplate;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title_templates = TitleTemplate::All();
        return view('backend.title_templates.index', compact('title_templates'));
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
            'title' => 'required',
        ]);
        $title_templates = new TitleTemplate;
        $title_templates->title = $request->title;
        // $title_templates->created_by = auth()->id();
        $title_templates->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TitleTemplate $title_templates
     * @return \Illuminate\Http\Response
     */
    public function show(TitleTemplate $title_templates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\title_templates $title_templates
     * @return \Illuminate\Http\Response
     */
    public function edit(TitleTemplate $title_templates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TitleTemplate $title_templates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TitleTemplate $title_template)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $title_template->title = $request->title;
        $title_template->save();

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TitleTemplate $title_templates
     * @return \Illuminate\Http\Response
     */
    public function destroy(TitleTemplate $title_template)
    {
        $title_template->delete();
        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }
}
