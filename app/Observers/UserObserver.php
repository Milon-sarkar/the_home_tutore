<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        if($user->user_type == null){
            $user->user_type = 'guardian';
            $user->save();
        }

    }
    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if($user->user_type == null){
            $user->user_type = 'guardian';
            $user->save();
        }
    }
}
