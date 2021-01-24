<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Auth;
use GreenHouse\Core\Request;
use GreenHouse\Models\City;
use GreenHouse\Models\House;
use GreenHouse\Models\Flat;

class HousesController extends FrontController {

    public function listHouses() {
        $this->render("houses/list", ["houses" => Auth::getInstance()->user->getHouses()]);
    }

    public function houseDetails($id){
        $house = new House($id);
        if ($house->exist()) {
            if ($house->belongsTo(Auth::getInstance()->user)) {
                $this->render("houses/details", [
                    "house" => $house,
                    "cities" => City::getAll(),
                    "flats" => Flat::getAll(["house_id" => $id])
                ]);
            } else $this->error_401();
        } else $this->error_404();
    }

    public function createPage(){
        $this->render("houses/create", [ "cities" => City::getAll()]);
    }

    public function createHouse(){
        $house = new House();
        $house->hydrate($_POST);
        $house->save();
        $this->redirect(route('houses'));
    }

    public function editHouse($id){
        $house = new House($id);
        if ($house->exist()) {
            if ($house->belongsTo(Auth::getInstance()->user)) {
                $house->hydrate($_POST);
                $house->save();
                $this->redirect(route('houses'));
            } else $this->error_401();
        } else $this->error_404();
    }

    public function deleteHouse($id) {
        $house = new House($id);
        if ($house->exist()) {
            if ($house->belongsTo(Auth::getInstance()->user)) {
                $house->delete();
                $this->redirect(route('houses'));
            } else $this->error_401();
        } else $this->error_404();
    }

}
