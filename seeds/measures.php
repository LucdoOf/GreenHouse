<?php

use GreenHouse\Models\Device;
use GreenHouse\Models\Flat;
use GreenHouse\Models\Measure;
use GreenHouse\Models\SQL;
use GreenHouse\Models\User;
use GreenHouse\Utils\Dbg;

SQL::db()->query("SET FOREIGN_KEY_CHECKS=0;");

SQL::truncate(Measure::STORAGE);
SQL::truncate(User::HOUSES_LINK_TABLE);

$measureCount = 8;
$startDate = new DateTime();
$yearInterval = new DateInterval("P1Y");
$endDate = (new DateTime())->add($yearInterval);
$userIndex = 0;
$users = User::getAll();

for ($i = 0; $i < $measureCount; $i++) {
    foreach (Device::getAll() as $device) {
        $measure = new Measure();
        $measure->start_date = $startDate->format("Y-m-d");
        $measure->end_date = $endDate->format("Y-m-d");
        $measure->device_id = $device->id;
        $measure->save();
    }

    foreach (Flat::getAll() as $flat) {
        $count = rand(1, 4);
        for ($j = 0; $j < $count; $j++) {
            SQL::insert(Flat::LODGERS_LINK_TABLE, [
                "user_id" => $users[$userIndex]->id,
                "flat_id" => $flat->id,
                "start_date" => $startDate->format("Y-m-d"),
                "end_date" => $endDate->format("Y-m-d"),
                "inhabitants_number" => $userIndex
            ]);
            $userIndex++;
        }
    }
    $startDate->add($yearInterval);
    $endDate->add($yearInterval);
}

