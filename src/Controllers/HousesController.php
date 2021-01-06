<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Request;
use GreenHouse\Models\City;
use GreenHouse\Models\House;

class HousesController extends FrontController {

    public function listHouses() {
        $this->render("houses/list", ["houses" => House::getAll()]);
    }

    public function houseDetails($id){
        $this->render("houses/details", ["house" => new House($id), "cities" => City::getAll()]);
    }

    public function editHouse($id){
        $house = new House($id);
        $house->name = Request::valueRequest("name");
        $house->zipcode = Request::valueRequest("zipcode");
        $house->number = Request::valueRequest("number");
        $house->isolation_degree = Request::valueRequest("isolation_degree");
        $house->eco_level = Request::valueRequest("eco_level");
        $house->street = Request::valueRequest("street");
        $house->city_id = Request::valueRequest("city_id");
        $house->save();
        $this->redirect(route('houses'));
    }

}
