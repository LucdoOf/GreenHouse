<?php

namespace GreenHouse\Controllers;

use DateInterval;
use DateTime;
use GreenHouse\Core\Auth;
use GreenHouse\Core\Request;
use GreenHouse\Models\City;
use GreenHouse\Models\House;
use GreenHouse\Models\Flat;
use GreenHouse\Models\SQL;
use GreenHouse\Models\User;
use GreenHouse\Utils\Dbg;

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
        SQL::db()->query("SET FOREIGN_KEY_CHECKS=0;");
        SQL::insert(User::HOUSES_LINK_TABLE, [
            "user_id" => Auth::getInstance()->user->id,
            "house_id" => $house->id,
            "start_date" => (new DateTime())->format("Y-m-d"),
            "end_date" => (new DateTime())->add((new DateInterval("P1Y")))->format("Y-m-d")
        ]);
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
