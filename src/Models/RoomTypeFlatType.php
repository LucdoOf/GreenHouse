<?php

namespace GreenHouse\Models;

class RoomTypeFlatType extends Model {

    const STORAGE = "flat_types_room_types";
    const COLUMNS = [
        "flat_type_id" => false,
        "room_type_id" => false,
    ];

    public $flat_type_id;
    public $room_type_id;

}
