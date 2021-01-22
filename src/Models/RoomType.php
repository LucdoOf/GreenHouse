<?php

namespace GreenHouse\Models;

class RoomType extends Model
{

    const STORAGE = "room_types";
    const COLUMNS = [
        "id" => true,
        "name" => false,
    ];

    public $name;
}
