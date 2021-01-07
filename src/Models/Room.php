<?php

namespace GreenHouse\Models;

class Room extends Model
{

    const STORAGE = "rooms";
    const COLUMNS = [
        "id" => false,
        "name" => true,
        "flat_id" => false,
        "room_type_id" => false,
    ];

    public $name;
    public $flat_id;
    public $room_type_id;
}