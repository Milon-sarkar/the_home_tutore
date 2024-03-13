<?php

namespace App\Http\Controllers;

use App\Models\Frontnumber;
use Illuminate\Http\Request;

class urgentContactController extends Controller
{
    public function urgent_contact(){
        //$numbers = Frontnumber::all();
        $numbers = Frontnumber::paginate(10);
        $selectedNumbers = [];
        return view('backend.urgent_contact.urgent_contact',compact('numbers','selectedNumbers'));
    }
}
