<?php

namespace GreenHouse\Models;

class DeviceTypes extends Model
{

    const STORAGE = "device_types";
    const COLUMNS = [
        "id" => true,
        "name" => false,
    ];

    public $name;
}