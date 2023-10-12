<?php
namespace App\Services;

interface AlarmsRepository 
{
    public function getAll();

    public function storeAll($alarms);
}