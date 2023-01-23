<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventService
{
    public static function checkEventDuplication($eventDate, $startTime, $endTime)
    {
        $is_Duplication = DB::table('events')
            ->whereDate('start_date', $eventDate)
            ->whereTime('end_date' ,'>',$startTime)
            ->whereTime('start_date', '<', $endTime)
            ->exists();

        return $is_Duplication;
    }

    public static function joinDateAndTime($date, $time)
    {
        $join = $date . " " . $time;
        $dateTime = Carbon::createFromFormat('Y-m-d H:', $join);

        return $dateTime;
    }
}