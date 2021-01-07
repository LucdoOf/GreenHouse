<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Request;
use GreenHouse\Models\City;
use GreenHouse\Models\Department;
use GreenHouse\Models\DeviceTypes;
use GreenHouse\Models\HarmfullSubstance;
use GreenHouse\Models\Region;
use GreenHouse\Models\Resource;

class ConfigurationController extends FrontController {

    public function configuration() {
        $this->render("configuration.container", [
            "regions" => Region::getAll(),
            "device_types" => DeviceTypes::getAll(),
            "substances" => HarmfullSubstance::getAll(),
            "resources" => Resource::getAll()
        ]);
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

    public function createType() {
        $name = Request::valueRequest("type_name");
        if($name){
            $device_type = new DeviceTypes();
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

}
