<?php

namespace GreenHouse\Controllers;

use DateTime;
use GreenHouse\Core\Request;
use GreenHouse\Models\Device;
use GreenHouse\Models\DeviceType;
use GreenHouse\Models\Flat;
use GreenHouse\Models\Measure;
use GreenHouse\Utils\Dbg;

class DevicesController extends FrontController {

    public function listDevices() {
        $this->render("devices/list", ["devices" => Device::getAll(), "types" => DeviceType::getAll(), "flats" => Flat::getAll()]);
    }

    public function deviceDetails($id){
        $this->render("devices/details", ["device" => new Device($id), "types" => DeviceType::getAll(), "flats" => Flat::getAll()]);
    }

    public function createPage(){
        $this->render("devices/create", ["types" => DeviceType::getAll(), "flats" => Flat::getAll()]);
    }

    public function editDevice($id){
        $device = new Device($id);
        if($device->exist()) {
            $device->name = Request::valueRequest("name");
            $device->demonstration_video = Request::valueRequest("video");
            $device->description = Request::valueRequest("description");
            $device->location = Request::valueRequest("location");
            $device->device_type_id = Request::valueRequest("type_id");
            $device->flat_id = Request::valueRequest("flat_id");
            $device->save();
            $this->redirect(route('devices'), ["message" => "Modification effectuée", "type" => "success"]);
        } else $this->redirect(route('devices'), ["message" => "Erreur lors de la modification", "type" => "error"]);
    }

    public function deleteDevice($id) {
        $device = new Device($id);
        if($device->exist()) {
            $device->delete();
            $this->redirect(route('devices'), ["message" => "Suppression effectuée", "type" => "success"]);
        } else $this->redirect(route("devices"), ["message" => "Erreur lors de la suppression", "type" => "error"]);
    }

    public function createDevice() {
        $device = new Device();
        if($device) { // Pas de test de duplication sur la BDD car plusieurs appareils peuvent être identiques
            $device->name = Request::valueRequest("name");
            $device->demonstration_video = Request::valueRequest("video");
            $device->description = Request::valueRequest("description");
            $device->location = Request::valueRequest("location");
            $device->device_type_id = Request::valueRequest("type_id");
            $device->flat_id = Request::valueRequest("flat_id");
            $device->save();
            $this->redirect(route('devices'), ["message" => "Ajout effectué", "type" => "success"]);
        } else $this->redirect(route("devices"), ["message" => "Erreur lors de l'ajout", "type" => "error"]);

    }

    public function createMeasure($id) {
        $device = new Device($id);
        if ($device->exist()) {
            $startDate = Request::valueRequest("start_date");
            $endDate = Request::valueRequest("end_date");
            $measure = new Measure();
            $measure->device_id = $device->id;
            $measure->start_date = DateTime::createFromFormat("d/m/Y", $startDate)->format("Y-m-d");
            $measure->end_date = DateTime::createFromFormat("d/m/Y",    $endDate)->format("Y-m-d");
            $measure->save();
            $this->redirect(route("device", [$id]), ["message" => "Ajout effectué", "type" => "success"]);
        } else {
            $this->error_404();
        }
    }

}
