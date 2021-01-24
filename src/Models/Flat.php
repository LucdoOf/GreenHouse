<?php

namespace GreenHouse\Models;

class Flat extends Model
{

    const STORAGE = "flats";
    const LODGER_LINK_TABLE = "flats_lodgers";
    const COLUMNS = [
        "id" => true,
        "name" => false,
        "house_id" => false,
        "flat_type_id" => false,
        "security_level" => false,
    ];

    public $name;
    public $house_id;
    public $flat_type_id;
    public $security_level;
}