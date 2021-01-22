<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Request;
use GreenHouse\Models\City;
use GreenHouse\Models\Department;
use GreenHouse\Models\Device;
use GreenHouse\Models\DeviceType;
use GreenHouse\Models\FlatType;
use GreenHouse\Models\HarmfullSubstance;
use GreenHouse\Models\Region;
use GreenHouse\Models\Resource;
use GreenHouse\Models\RoomType;
use GreenHouse\Models\RoomTypeFlatType;
use GreenHouse\Models\SQL;

class ConfigurationController extends FrontController {

    public function configuration() {
        $this->render("configuration.container", [
            "regions" => Region::getAll(),
            "device_types" => DeviceType::getAll(),
            "substances" => HarmfullSubstance::getAll(),
            "resources" => Resource::getAll(),
            "room_types" => RoomType::getAll(),
            "flat_types" => FlatType::getAll()
        ]);
    }

    public function linkRoomType($flatType_id) {
        $roomTypeId = Request::valueRequest("linked_roomType");
        if($roomTypeId && $flatType_id){
            $roomTypeFlatType = new RoomTypeFlatType();
            $roomTypeFlatType->flat_type_id = $flatType_id;
            $roomTypeFlatType->room_type_id = $roomTypeId;
            $roomTypeFlatType->save();
        }
        $this->redirect(route("configuration"));
    }

    public function createFlatType() {
        $name = Request::valueRequest("flat_type_name");
        if($name){
            $flat_type = new FlatType();
            $flat_type->name = $name;
            $flat_type->save();
        }
        $this->redirect(route("configuration"));
    }

    public function createRoomType() {
        $name = Request::valueRequest("room_type_name");
        if($name){
            $room_type = new RoomType();
            $room_type->name = $name;
            $room_type->save();
        }
        $this->redirect(route("configuration"));
    }

    public function createRegion() {
        $name = Request::valueRequest("name");
        if ($name) {
            $region = new Region();
            $region->name = $name;
            $region->save();
        }
        $this->redirect(route("configuration"));
    }

    public function createDepartment($regionId) {
        $region = new Region($regionId);
        if ($region->exist()) {
            $name = Request::valueRequest("name");
            if ($name) {
                $department = new Department();
                $department->name = $name;
                $department->region_id = $regionId;
                $department->save();
            }
        }
        $this->redirect(route("configuration"));
    }

    public function createCity($departmentId) {
        $department = new Department($departmentId);
        if ($department->exist()) {
            $name = Request::valueRequest("name");
            if ($name) {
                $city = new City();
                $city->name = $name;
                $city->department_id = $departmentId;
                $city->save();
            }
        }
        $this->redirect(route("configuration"));
    }

    public function createDeviceType() {
        $name = Request::valueRequest("type_name");
        if($name){
            $device_type = new DeviceType();
            $device_type->name = $name;
            $device_type->save();
        }
        $this->redirect(route("configuration"));
    }

    public function createResource() {
        $this->render("configuration.resources.create", []);
    }

    public function createSubstance() {
        $this->render("configuration.substances.create", []);
    }

    public function createResourcePost() {
        $resource = new Resource();
        $resource->name = Request::valueRequest("name");
        $resource->description = Request::valueRequest("description");
        $resource->min_value = Request::valueRequest("min_value");
        $resource->max_value = Request::valueRequest("max_value");
        $resource->ideal_value = Request::valueRequest("ideal_value");
        $resource->critical_value = Request::valueRequest("critical_value");
        $resource->save();
        $this->redirect(route("configuration"));
    }

    public function createSubstancePost() {
        $substance = new HarmfullSubstance();
        $substance->name = Request::valueRequest("name");
        $substance->description = Request::valueRequest("description");
        $substance->min_value = Request::valueRequest("min_value");
        $substance->max_value = Request::valueRequest("max_value");
        $substance->ideal_value = Request::valueRequest("ideal_value");
        $substance->critical_value = Request::valueRequest("critical_value");
        $substance->save();
        $this->redirect(route("configuration"));
    }

    public function deviceTypeDetails($id) {
        $deviceType = new DeviceType($id);
        if ($deviceType->exist()) {
            $this->render("configuration.deviceTypes.details", ["deviceType" => $deviceType]);
        } else {
            $this->error_404();
        }
    }

    public function linkResource($id) {
        $deviceType = new DeviceType($id);
        if ($deviceType->exist()) {
            $this->render("configuration.resources.link", ["deviceType" => $deviceType]);
        } else {
            $this->error_404();
        }
    }

    public function linkResourcePost($id) {
        $deviceType = new DeviceType($id);
        if ($deviceType->exist()) {
            $consumptionRate = Request::valueRequest("consumption_rate");
            $resourceId = Request::valueRequest("resource_id");
            if ($consumptionRate && $resourceId) {
                SQL::insert(DeviceType::RESOURCES_LINK_STORAGE, [
                    "consumption_rate" => $consumptionRate,
                    "resource_id" => $resourceId,
                    "device_type_id" => $deviceType->id
                ]);
                $this->redirect(route("configuration.device-type", [$deviceType->id]));
            }
        } else {
            $this->error_404();
        }
    }

    public function linkSubstance($id) {
        $deviceType = new DeviceType($id);
        if ($deviceType->exist()) {
            $this->render("configuration.substances.link", ["deviceType" => $deviceType]);
        } else {
            $this->error_404();
        }
    }

    public function linkSubstancePost($id) {
        $deviceType = new DeviceType($id);
        if ($deviceType->exist()) {
            $productionRate = Request::valueRequest("production_rate");
            $substanceId = Request::valueRequest("substance_id");
            if ($productionRate && $substanceId) {
                SQL::insert(DeviceType::SUBSTANCES_LINK_STORAGE, [
                    "production_rate" => $productionRate,
                    "harmfull_substance_id" => $substanceId,
                    "device_type_id" => $deviceType->id
                ]);
                $this->redirect(route("configuration.device-type", [$deviceType->id]));
            }
        } else {
            $this->error_404();
        }
    }

}
