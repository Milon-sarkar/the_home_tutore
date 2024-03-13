<?php

namespace App\Http\Controllers;

use App\Models\hireBanner;
use App\Models\Hires;
use Illuminate\Http\Request;

class HireController extends Controller
{
    public function hire(){
        $hireBanners = hireBanner::all();
        return view('frontend.hire.hire',compact('hireBanners'));
    }

    public function store(Request $request){
        try {
            $hire = new Frontnumber();
            $hire->phone = $request->number;
            $hire->save();
            return redirect()->back()->with('success', 'Submission successful!');

        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'This number is already registered.');
        }
    }


}
