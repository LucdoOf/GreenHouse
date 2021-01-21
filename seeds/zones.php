<?php

use GreenHouse\Models\City;
use GreenHouse\Models\Department;
use GreenHouse\Models\SQL;
use GreenHouse\Utils\Dbg;

require "../src/boot.php";

$zoneData = json_decode(file_get_contents("zones.json"), true);

foreach ($zoneData as $data) {
    $department = Department::select(["name" => $data["admin_name"]]);
    if ($department->exist()) {
        $city = new City();
        $city->name = $data["city"];
        $city->department_id = $department->id;
        $city->save();
    } else {
        Dbg::warning("Unknown department: " . $data["admin_name"]);
    }
}
