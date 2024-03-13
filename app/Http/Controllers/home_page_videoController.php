<?php

namespace App\Http\Controllers;

use App\Models\HomeVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class home_page_videoController extends Controller
{
    public function index()
    {
        
        $HomeVideos = HomeVideo::All();
        // dd($hireBanners);
        return view('backend.home_page_video.index', compact('HomeVideos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
 

    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi|max:10240', // Adjust file types and size as needed
            'image' => 'required', // Adjust file types and size as needed
        ]);
        $videoPath = Storage::put('storage/videos', $request->file('video'));
        $imagePath = $request->file('image')->store('hireBanner_images', 'public');  
      
        HomeVideo::create([
            'video' => $videoPath,
            'image' => $imagePath,
        ]);  

        return redirect()->back()->with('success', 'Video uploaded successfully')->with('videoPath', $videoPath);
    }
    

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\hireBanner $hireBanners
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(hireBanner $hireBanners)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\hireBanner $hireBanners
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(hireBanner $hireBanners)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\hireBanner $hireBanners
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
        
    //     $this->validate($request, [
    //         'image' => 'required',
    //     ]);


    //     $HomeVideos = HomeVideo::find($id);
    //     $imagePath = $request->file('image')->store('hireBanner_images', 'public');
    //     $HomeVideos->image = $imagePath;
    //     $HomeVideos->update();
    
    //     return redirect()->back()->with('success', 'Data Updated Successfully');
    // }
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\hireBanner $hireBanners
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {   
        // dd($id);
        HomeVideo::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Video Deleted Successfully');
    }
}
