<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Request;
use GreenHouse\Models\Flat;
use GreenHouse\Models\SQL;
use GreenHouse\Models\User;
use GreenHouse\Utils\Dbg;

class FlatsController extends FrontController{

    public function listFlats() {
        $this->render("flats/list", ["flats" => Flat::getAll()]);
    }

    public function flatDetails($id){
        $this->render("flats/details", ["flat" => new Flat($id), "lodgers" => SQL::select(Flat::LODGER_LINK_TABLE, ["flat_id" => $id])]);
    }

    public function editFlat($id){
        $flat = new Flat($id);
        $flat->name = Request::valueRequest("name");
        $flat->house_id = Request::valueRequest("house_id");
        $flat->flat_type_id = Request::valueRequest("type_id");
        $flat->security_level = Request::valueRequest("security");
        $flat->save();
        $this->redirect(route('flats'));
    }

    public function addLodger($id){
        $this->render("flats.create-lodger", ["flat" => new Flat($id), "flats" => Flat::getAll(), "users" => User::getAll()]);
    }

    public function addLodgerPost($id){
        if(Request::valueRequest("user_id") && Request::valueRequest("sdate")) {
            if(Request::valueRequest("numb") && Request::valueRequest("edate")) {
                SQL::insert(Flat::LODGER_LINK_TABLE, ["user_id" => Request::valueRequest("user_id"), "flat_id" => $id, "start_date" => Request::valueRequest("sdate"), "end_date" => Request::valueRequest("edate"), "inhabitants_number" => Request::valueRequest("numb")]);
            } else if(Request::valueRequest("numb")) {
                SQL::insert(Flat::LODGER_LINK_TABLE, ["user_id" => Request::valueRequest("user_id"), "flat_id" => $id, "start_date" => Request::valueRequest("sdate"), "inhabitants_number" => Request::valueRequest("numb")]);
            } else if(Request::valueRequest("edate")){
                SQL::insert(Flat::LODGER_LINK_TABLE, ["user_id" => Request::valueRequest("user_id"), "flat_id" => $id, "start_date" => Request::valueRequest("sdate"), "end_date" => Request::valueRequest("edate")]);
            } else {
                SQL::insert(Flat::LODGER_LINK_TABLE, ["user_id" => Request::valueRequest("user_id"), "flat_id" => $id, "start_date" => Request::valueRequest("sdate")]);
            }
        }
        $this->redirect(route('flat', [$id]));
    }

}