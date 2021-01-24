<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Request;
use GreenHouse\Models\House;
use GreenHouse\Models\Flat;
use GreenHouse\Models\FlatType;
use GreenHouse\Models\Room;
use GreenHouse\Models\RoomType;
use GreenHouse\Models\SQL;
use GreenHouse\Models\User;
use GreenHouse\Utils\Dbg;

class FlatsController extends FrontController{

    public function listFlats() {
        $this->render("flats/list", ["flats" => Flat::getAll()]);
    }

    public function flatDetails($id){
        $flat = new Flat($id);
        if ($flat->exist()) {
            $this->render("flats/details", [
                "flat" => $flat,
                "lodgers" => SQL::select(Flat::LODGERS_LINK_TABLE, ["flat_id" => $id]),
                "rooms" => Room::getAll(["flat_id" => $id]),
                "houses" => House::getAll(),
                "flat_types" => FlatType::getAll()
            ]);
        } else $this->error_404();
    }

    public function createFlat(){
        $flat = new Flat();
        $test = Flat::getAll(["name" => Request::valueRequest("name")]);
        if(empty($test) && $flat && Request::valueRequest("name") &&
            Request::valueRequest("house_id") &&
            Request::valueRequest("type_id") &&
            Request::valueRequest("security")) {
            $flat->name = Request::valueRequest("name");
            $flat->house_id = Request::valueRequest("house_id");
            $flat->flat_type_id = Request::valueRequest("type_id");
            $flat->security_level = Request::valueRequest("security");
            $flat->save();
            $this->redirect(route('flats'), ["message" => "Appartement ajouté", "type" => "success"]);
        } else $this->redirect(route('flats'), ["message" => "Veuillez saisir tous les champs", "type" => "error"]);
    }

    public function editFlat($id){
        $flat = new Flat($id);
        if($flat->exist()) {
            $flat->name = Request::valueRequest("name");
            $flat->house_id = Request::valueRequest("house_id");
            $flat->flat_type_id = Request::valueRequest("type_id");
            $flat->security_level = Request::valueRequest("security");
            $flat->save();
            $this->redirect(route('flats'), ["message" => "Appartement modifié", "type" => "success"]);
        } else $this->error_404();
    }

    public function createPage(){
        $this->render("flats/create", [ "houses" => House::getAll(), "flat_types" => FlatType::getAll()]);
    }

    public function deleteFlat($id) {
        $flat = new Flat($id);
        if($flat) {
            $flat->delete();
            $this->redirect(route('flats'), ["message" => "Appartement supprimé", "type" => "success"]);
        } else $this->error_404();
    }

    public function addLodger($id){
        $flat = new Flat($id);
        if ($flat->exist()) {
            $this->render("flats.create-lodger", [
                "flat" => $flat,
                "users" => User::getAll()
            ]);
        } else $this->error_404();
    }

    public function addRoom($id){
        $flat = new Flat($id);
        if ($flat->exist()) {
            $this->render("flats.create-room", [
                "flat" => $flat,
                "roomTypes" => RoomType::getAll()
            ]);
        } else $this->error_404();
    }

    public function addLodgerPost($id){
        if(Request::valueRequest("user_id") && Request::valueRequest("sdate")) {
            if(Request::valueRequest("numb") && Request::valueRequest("edate")) {
                SQL::insert(Flat::LODGERS_LINK_TABLE, [
                    "user_id" => Request::valueRequest("user_id"),
                    "flat_id" => $id, "start_date" => Request::valueRequest("sdate"),
                    "end_date" => Request::valueRequest("edate"),
                    "inhabitants_number" => Request::valueRequest("numb")
                ]);
            } else if(Request::valueRequest("numb")) {
                SQL::insert(Flat::LODGERS_LINK_TABLE, [
                    "user_id" => Request::valueRequest("user_id"),
                    "flat_id" => $id,
                    "start_date" => Request::valueRequest("sdate"),
                    "inhabitants_number" => Request::valueRequest("numb")
                ]);
            } else if(Request::valueRequest("edate")){
                SQL::insert(Flat::LODGERS_LINK_TABLE, [
                    "user_id" => Request::valueRequest("user_id"),
                    "flat_id" => $id,
                    "start_date" => Request::valueRequest("sdate"),
                    "end_date" => Request::valueRequest("edate")
                ]);
            } else {
                SQL::insert(Flat::LODGERS_LINK_TABLE, [
                    "user_id" => Request::valueRequest("user_id"),
                    "flat_id" => $id,
                    "start_date" => Request::valueRequest("sdate")
                ]);
            }
            $this->redirect(route('flat', [$id]), ["message" => "Habitant ajouté", "type" => "success"]);
        } else $this->redirect(route('flat', [$id]), ["message" => "Veuillez saisir une date ainsi qu'un utilisateur valide", "type" => "error"]);
    }

}
