<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\FileCustomizeTrait;
use DB;
use Hash;
use Illuminate\Support\Arr;
class SettingController extends Controller
{
    public function __construct(){

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $setting = Setting::find(1);
        if($setting == false){
            $setting = new Setting();
            $setting->id = 1;
            $setting->save();
        }
        return view('backend.setting.config',compact('setting'));
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
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return redirect('/admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        request()->validate([
            'name' => 'required',
        ]);

        $setting->update($setting->all());


        return redirect()->route('settigs.index')
            ->with('success','Setting Update successfully.');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        request()->validate([
            'name' => 'required',
            'welcome_title_on_image' => 'nullable|max:100',
            'welcome_short_title_on_image' => 'nullable|max:160',
        ]);
        $setting = Setting::findOrFail(1);

        if($setting == false){
            $setting = new Setting();
            $setting->id = 1;
            $setting->save();
        }

        $setting->name =$request->name;
        $setting->owner =$request->owner;
        $setting->address =$request->address;
        $setting->email =$request->email;
        $setting->geocode =$request->geocode;
        $setting->phone =$request->phone;
        $setting->meta_title =$request->meta_title;
        $setting->meta_description =$request->meta_description;
        $setting->meta_keywords =$request->meta_keywords;
        $setting->facebook =$request->facebook;
        $setting->instagram =$request->instagram;
        $setting->linkedin =$request->linkedin;
        $setting->youtube =$request->youtube;
        $setting->twitter =$request->twitter;
        $setting->welcome_title_on_image =$request->welcome_title_on_image;
        $setting->welcome_short_title_on_image =$request->welcome_short_title_on_image;
        $setting->welcome_dark_overlay_on_image =$request->welcome_dark_overlay_on_image == 'on' ? 1 : 0;

        $arr=array();

        if($request->link_names){
            foreach($request->link_names as $key => $name){
                $index = ['name' => $name, 'link' => $request->links[$key]];
                array_push($arr, $index);
            }
        }

        $setting->link = json_encode($arr);



        if($request->hasFile('logo')){
            FileCustomizeTrait::deleteFile($setting->logo);
            $file = $request->file('logo');
            $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;

            $destinationPath = public_path().'/storages/logo/' ;

            $file->move($destinationPath,$fileName);

            $setting->logo = '/storages/logo/'.$fileName;
        }

        if($request->hasFile('favicon')){
            FileCustomizeTrait::deleteFile($setting->favicon);
            $file = $request->file('favicon');
            $fileName =  uniqid().'.'.$file->getClientOriginalExtension() ;

            $destinationPath = public_path().'/storages/logo/' ;

            $file->move($destinationPath,$fileName);

            $setting->favicon = '/storages/logo/'.$fileName;
        }


        if($request->welcome_image){
            $oldImage = $setting->welcome_image;


            $imageNameWithDestination = FileCustomizeTrait::img_manupulate_from_base64($request->welcome_image, '/storages/welcome_images/');
            $setting->welcome_image = $imageNameWithDestination;

            FileCustomizeTrait::deleteFile($oldImage);
        }

        $setting->save();
        //Setting::where('id', 1)->update($request->all());

        return redirect()->route('setting.index')
            ->with('success','Setting Update successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
