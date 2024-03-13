<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\FileCustomizeTrait;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('backend.pages.list', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required'
        ]);
        $page = new Page();
        $page->title = $request->title;
        $page->details = $request->details;
        if ($request->has('banner')){
            $file = $request->file('banner') ;
            $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
            $destinationPath = public_path().'/storages/page/' ;
            $file->move($destinationPath,$fileName);
            $page->banner = '/storages/page/'.$fileName;
        }
        $page->save();

        $slug = Str::slug($request->title);
        if (Page::where('slug', $slug)->exists()){
            $slug .= '-' . $page->id;
        }
        $page->slug = $slug;
        $page->save();

        //Toastr::success('Page Created', "Success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('backend.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $page = Page::findOrFail($id);
        $page->title = $request->title;
        $page->details = $request->details;
        if ($id != 1 && $id != 2){
            $page->slug = null;
        }

        if ($request->has('banner')){
            FileCustomizeTrait::deleteFile($request->banner);
            $file = $request->file('banner') ;
            $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;
            $destinationPath = public_path().'/storages/page/' ;
            $file->move($destinationPath,$fileName);
            $page->banner = '/storages/page/'.$fileName;
        }
        $page->save();

        if ($id != 1 && $id != 2){
            $slug = Str::slug($request->title);
            if (Page::where('slug', $slug)->exists()){
                $slug .= '-' . $page->id;
            }
            $page->slug = $slug;
            $page->save();
        }


        //Toastr::success('Page Updated', "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == 1 || $id == 2){
            //Toastr::error('Sorry!These page are not deletable.');
            return back();
        }
        $page = Page::findOrFail($id);
        FileCustomizeTrait::deleteFile($page->banner);
        $page->delete();

        //Toastr::success('Page Deleted!', 'Success');
        return back();
    }
}
