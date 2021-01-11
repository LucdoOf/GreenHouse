<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Request;
use GreenHouse\Models\Device;
use GreenHouse\Models\DeviceType;
use GreenHouse\Models\Flat;
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
        $device->name = Request::valueRequest("name");
        $device->demonstration_video = Request::valueRequest("video");
        $device->description = Request::valueRequest("description");
        $device->location = Request::valueRequest("location");
        $device->device_type_id = Request::valueRequest("type_id");
        $device->flat_id = Request::valueRequest("flat_id");
        $device->save();
        $this->redirect(route('devices'));
    }

    public function deleteDevice($id) {
        $device = new Device($id);
        $device->delete();
        $this->redirect(route('devices'));
    }

    public function createDevice() {
        $device = new Device();
        $device->name = Request::valueRequest("name");
        $device->demonstration_video = Request::valueRequest("video");
        $device->description = Request::valueRequest("description");
        $device->location = Request::valueRequest("location");
        $device->device_type_id = Request::valueRequest("type_id");
        $device->flat_id = Request::valueRequest("flat_id");
        $device->save();
        $this->redirect(route('devices'));

    }

}
