<?php

namespace App\Http\Controllers;

use App\Models\SentSMS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SendSMSController
{
    public function send_sms(Request $request)
    {

        $request->validate([
            'sms_body' => 'required|max: 300| min: 10',
            'sms_type' => ['required', Rule::in('multiple', 'single')],
        ]);
        $numbers = explode(',', $request->tutor_phones_numbers);

        foreach ($numbers as $number) {
            $user = User::where('phone', $number)->first();
            if ($user == null) {
                continue;
            }
            $sent_sms = new SentSMS;
            $sent_sms->user_id = $user->id;
            $sent_sms->phone_number = $user->phone;
            $sent_sms->sms_body = $request->sms_body;
            $sent_sms->sms_status = 1;
            $sent_sms->save();
        }

        sendSms($request->tutor_phones_numbers, $request->sms_body);


        return back()->withSuccess('Message sent successfully');
    }

    public function sent_sms()
    {
        $sent_smses = SentSMS::paginate(20);

        return view('backend.sent_sms.index', compact('sent_smses'));
    }

    public function sendSms(Request $request)
    {
        $request->validate([
            'sms_body' => 'required|max:300|min:10',
            'sms_type' => ['sometimes', Rule::in(['multiple', 'single'])],
 
        ]);
    
        $user = auth()->user();
    
        // Save the sent SMS record
        $sent_sms = new SentSMS;
        $sent_sms->user_id = $user->id;
        $sent_sms->phone_number = $request->guardian_phone_modal;
        $sent_sms->sms_body = $request->sms_body;
        $sent_sms->sms_status = 1;
        $sent_sms->save();
    
        sendSms($request->guardian_phone_modal, $request->sms_body);
    
        return back()->withSuccess('Message sent successfully');
    }
    
}
