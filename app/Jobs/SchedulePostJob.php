<?php

use App\Models\Tuition;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SchedulePostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tuition;

    public function __construct(Tuition $tuition)
    {
        $this->tuition = $tuition;
    }

    public function handle()
    {
        Log::info('Handling SchedulePostJob');
        // Logic to create the post based on $this->tuition
        $this->tuition->status = '0';
        $tuitions = Tuition::get()->count();
        $code = $tuitions + 1;
        $this->tuition->job_id = $code;
        $this->tuition->save();
        Log::info('SchedulePostJob handled successfully');
    }
}
