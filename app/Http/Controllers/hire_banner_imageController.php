<?php

namespace App\Http\Controllers;

use App\Models\hireBanner;
use Illuminate\Http\Request;

class hire_banner_imageController extends Controller
{
    public function index()
    {
        
        $hireBanners = hireBanner::All();
        // dd($hireBanners);
        return view('backend.hire_banner_image.index', compact('hireBanners'));
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
        $imagePath = $request->file('image')->store('hireBanner_images', 'public');
        // dd($imagePath);
        $hireBanners = new hireBanner;
        $hireBanners->image = $imagePath;
        // $title_templates->created_by = auth()->id();
        $hireBanners->save();

        return redirect()->back()->with('success', 'Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hireBanner $hireBanners
     * @return \Illuminate\Http\Response
     */
    public function show(hireBanner $hireBanners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hireBanner $hireBanners
     * @return \Illuminate\Http\Response
     */
    public function edit(hireBanner $hireBanners)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\hireBanner $hireBanners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'image' => 'required',
        ]);


        $hireBanners = hireBanner::find($id);
        $imagePath = $request->file('image')->store('hireBanner_images', 'public');
        //   dd($imagePath);
        $hireBanners->image = $imagePath;
        // dd($hireBanners->image);
        $hireBanners->update();
    
        return redirect()->back()->with('success', 'Data Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hireBanner $hireBanners
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // dd($id);
        hireBanner::where('id',$id)->delete();
        return redirect()->back()->with('success', 'image Deleted Successfully');
    }
}
