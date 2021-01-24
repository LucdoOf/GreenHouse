<?php

namespace GreenHouse\Models;

class Room extends Model
{

    const STORAGE = "rooms";
    const COLUMNS = [
        "id" => true,
        "name" => false,
        "flat_id" => false,
        "room_type_id" => false,
    ];

    public $name;
    public $flat_id;
    public $room_type_id;
}