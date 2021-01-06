<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Request;
use GreenHouse\Models\Device;

class FlatsController extends FrontController{

    public function listFlats() {
        $this->render("flats/list", ["flats" => Flat::getAll()]);
    }

    public function flatDetails($id){
        $this->render("flats/details", ["flat" => new Flat($id)]);
    }

    public function editFlat($id){
        $flat = new Flat($id);
        $flat->name = Request::valueRequest("name");
        $flat->house_id = Request::valueRequest("house_id");
        $flat->flat_type_id = Request::valueRequest("type_id");
        $flat->security_level = Request::valueRequest("security");
        $flat->save();
        $this->redirect(route('flat', [$flat->id]));
    }

}