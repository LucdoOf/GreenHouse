<?php

namespace GreenHouse\Models;

class Flat extends Model
{

    const STORAGE = "flats";
    const COLUMNS = [
        "id" => false,
        "name" => true,
        "flat_type_id" => false,
        "house_id" => false,
        "security_level" => true,
    ];

    public $name;
    public $house_id;
    public $flat_type_id;
    public $security_level;
}