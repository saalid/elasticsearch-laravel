<?php

namespace App\Services;

use App\Services\Alarm\Alarm;
use App\Services\AlarmsRepository;
use Illuminate\Support\Facades\Storage;

class JsonAlarmsRepository implements AlarmsRepository
{
    public function getAll()
    {
        $content = Storage::disk('public')->get('alarms.json');
        $result = json_decode($content);

        return array_map(function($item) {
            return Alarm::createFromArray((array) $item);
        }, $result);
    }

    public function storeAll($alarms)
    {
        $alarmsAsJson = array_map(function($item) {
            return $item->toArray();
        }, $alarms);

        Storage::disk('public')->put('alarms.json', json_encode($alarmsAsJson));
    }
}