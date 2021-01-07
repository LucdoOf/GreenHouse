<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Request;
use GreenHouse\Models\Room;

class RoomsController extends FrontController{

    public function listRooms() {
        $this->render("rooms/list", ["rooms" => Room::getAll()]);
    }

    public function roomDetails($id){
        $this->render("rooms/details", ["room" => new Room($id)]);
    }

    public function editRoom($id){
        $room = new Room($id);
        $room->name = Request::valueRequest("name");
        $room->flat_id = Request::valueRequest("flat_id");
        $room->room_type_id = Request::valueRequest("type_id");
        $room->save();
        $this->redirect(route('room', [$room->id]));
    }

}