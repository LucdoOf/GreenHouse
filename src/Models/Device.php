<?php

namespace GreenHouse\Models;

class Device extends Model {

    const STORAGE = "devices";
    const COLUMNS = [
        "id" => true,
        "name" => false,
        "demonstration_video" => false,
        "location" => false,
        "description" => false,
        "device_type_id" => false,
        "flat_id" => false
    ];

    public $name;
    public $demonstration_video;
    public $location;
    public $description;
    public $device_type_id;
    public $flat_id;

}
