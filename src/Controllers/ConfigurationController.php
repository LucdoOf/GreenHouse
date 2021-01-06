<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Request;
use GreenHouse\Models\City;
use GreenHouse\Models\Department;
use GreenHouse\Models\Region;

class ConfigurationController extends FrontController {

    public function configuration() {
        $this->render("configuration.container", ["regions" => Region::getAll()]);
    }

    public function createRegion() {
        $name = Request::valueRequest("name");
        if ($name) {
            $region = new Region();
            $region->name = $name;
            $region->save();
        }
        $this->redirect(route("configuration.zones"));
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
        $this->redirect(route("configuration.zones"));
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
        $this->redirect(route("configuration.zones"));
    }

}
