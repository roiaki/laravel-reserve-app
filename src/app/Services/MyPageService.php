<?php

namespace App\Services;

use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class MyPageService
{
    // 予約されたイベント情報を取得する
    public static function reservedEvent($events, $string)
    { 
        $reservedEvents = [];
        $nowDate = Carbon::now()->format('Y-m-d 00:00:00');

        // 現在以降のイベントを取得
        if($string === 'fromToday') {
            foreach($events->sortBy('start_date') as $event) {
                if(is_null($event->pivot->canceled_date) && $event->start_date >= $nowDate) {
                    $eventInfo = [
                        'id' => $event->id,
                        'name' => $event->name,
                        'start_date' => $event->start_date,
                        'end_date' => $event->end_date,
                        'number_of_people' => $event->pivot->number_of_people
                    ];
                array_push($reservedEvents, $eventInfo);
                }
            }
        }

        // 過去のイベントを取得
        if($string === 'past') {
            foreach($events->sortByDesc('start_date') as $event) {
                if(is_null($event->pivot->canceled_date) && $event->start_date < $nowDate) {
                        $eventInfo = [
                            'id' => $event->id,
                            'name' => $event->name,
                            'start_date' => $event->start_date,
                            'end_date' => $event->end_date,
                            'number_of_people' => $event->pivot->number_of_people
                        ];
                    array_push($reservedEvents, $eventInfo);
                }
            }
        }
        return $reservedEvents;
   }
}