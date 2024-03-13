<?php

namespace App\Observers;

use App\Models\Tuition;

class TuitionObserver
{
    public function created(Tuition $tuition)
    {
        if($tuition->created_by == null){
            $tuition->created_by = auth()->user()->id ?? 0;
            $tuition->save();
        }

    }
}
