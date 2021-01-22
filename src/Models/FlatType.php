<?php

namespace GreenHouse\Models;

class FlatType extends Model
{

    const STORAGE = "flat_types";
    const COLUMNS = [
        "id" => true,
        "name" => false,
    ];

    public $name;

    public function getLinkedRoomTypes() {
        $toReturn = [];
        foreach (RoomTypeFlatType::getAll(["flat_type_id" => $this->id]) as $tmp){
            $toReturn[] = new RoomType($tmp->room_type_id);
        }
        return $toReturn;
    }

}
