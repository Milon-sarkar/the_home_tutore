<?php

namespace App\Http\Controllers;

use App\Models\SentSMS;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SendNotificationController
{
    public function send_notification(Request $request){

        $request->validate([
            'notification_body' => 'required|max: 500| min: 10',
            'notification_type' => ['required',Rule::in('multiple','single')],
        ]);
        $user_ids = explode(',',$request->user_ids);

        foreach ($user_ids as $user_id){
            $user = User::where('id', $user_id)->first();
            if($user == null){
                continue;
            }
            $user_notification = new UserNotification();
            $user_notification->user_id = $user->id;
            $user_notification->notification_title = $request->notification_title;
            $user_notification->notification_body = $request->notification_body;
            $user_notification->notification_status = 1;
            $user_notification->save();
        }

        return back()->withSuccess('Notification sent successfully');

    }

    public function sent_notification(){
        $sent_notifications = UserNotification::paginate(50);

        return view('backend.sent_notification.index',compact('sent_notifications'));
    }


}
