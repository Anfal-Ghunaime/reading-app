<?php

namespace App\Services\TimeHandling;

use Carbon\Carbon;

class TimeDiffSumAvgService
{
    public function calculateDiff($start_time, $end_time): string
    {
        $start_time = Carbon::createFromTimeString($start_time);
        $end_time = Carbon::createFromTimeString($end_time);
        $difference = $end_time->diff($start_time);
        return $difference->format('%H:%I:%S');
    }

    public function calculateSum($times): string
    {
        $service  = new TimeFormatService();
        $total_time = 0;
        foreach ($times as $time){
            $seconds = $service->toSeconds($time);
            $total_time += $seconds;
        }
        return $service->toHIS_format($total_time);
    }

    public function calculateAvg($times): string
    {
        $service  = new TimeFormatService();
        $counter = 0;
        foreach ($times as $time){
            $counter++;
        }
        $total_time = $this->calculateSum($times);
        $seconds = $service->toSeconds($total_time);
        $sec = $seconds/$counter;
        return $service->toHIS_format($sec);
    }
}
