<?php

namespace App\Services\TimeHandling;

class TimeFormatService
{
    public function toSeconds($time): float|int|string
    {
        $parts = explode(':', $time);
        return (isset($parts[0])? $parts[0] * 3600 : 0) +
            (isset($parts[1])? $parts[1] * 60 : 0) +
            ($parts[2] ?? 0);
    }

    public function toHIS_format($time): string
    {
        $hours = floor($time/3600);
        $minutes = floor($time/60) % 60;
        $seconds = $time % 60;
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }
}
