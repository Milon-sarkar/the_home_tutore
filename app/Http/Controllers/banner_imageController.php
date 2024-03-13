<?php

namespace App\Http\Controllers;

use App\Models\banner;
use Illuminate\Http\Request;

class banner_imageController extends Controller
{
 

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $banners = banner::All();
        // dd($banners);
        return view('backend.banner_image.index', compact('banners'));
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
            'image' => 'required',
        ]);
        $imagePath = $request->file('image')->store('banner_images', 'public');
        // dd($imagePath);
        $banners = new banner;
        $banners->image = $imagePath;
        // $title_templates->created_by = auth()->id();
        $banners->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\banner $banners
     * @return \Illuminate\Http\Response
     */
    public function show(banner $banners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\banner $banners
     * @return \Illuminate\Http\Response
     */
    public function edit(banner $banners)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\banner $banners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'image' => 'required',
        ]);


        $banners = banner::find($id);
        $imagePath = $request->file('image')->store('banner_images', 'public');
        //   dd($imagePath);
        $banners->image = $imagePath;
        // dd($banners->image);
        $banners->update();
    
        return redirect()->back()->with('success', 'Data Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\banner $banners
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // dd($id);
        banner::where('id',$id)->delete();
        return redirect()->back()->with('success', 'image Deleted Successfully');
    }
}
