<?php

namespace GreenHouse\Models;

class DeviceType extends Model
{

    const STORAGE = "device_types";
    const COLUMNS = [
        "id" => true,
        "name" => false,
    ];

    public $name;
}