<?php

use GreenHouse\Controllers\ConfigurationController;
use GreenHouse\Controllers\DevicesController;
use GreenHouse\Controllers\HousesController;
use GreenHouse\Controllers\LoginController;

return [
    'login'                                 => ["GET", "/login", [LoginController::class, "login"]],
    'houses'                                => ["GET", "/houses", [HousesController::class, "listHouses"]],
    'house.edit'                            => ["POST", "/houses/edit/(.+)", [HousesController::class, "editHouse"]],
    'house'                                 => ["GET", "/houses/(.+)", [HousesController::class, "houseDetails"]],
    'auth'                                  => ["POST", "/auth", [LoginController::class, "auth"]],
    'test'                                  => ["GET", "/test/(.+)/test/(.+)", [LoginController::class, "test"]],
    'logout'                                => ["GET", "/logout", [LoginController::class, "logout"]],
    'configuration'                         => ["GET", "/configuration", [ConfigurationController::class, "configuration"]],
    'configuration.regions.create'          => ["POST", "/configuration/zones/regions/create", [ConfigurationController::class, "createRegion"]],
    'configuration.departments.create'      => ["POST", "/configuration/zones/regions/(.+)/departments/create", [ConfigurationController::class, "createDepartment"]],
    'configuration.cities.create'           => ["POST", "/configuration/zones/departments/(.+)/cities/create", [ConfigurationController::class, "createCity"]],
    'devices'                               => ["GET", "/devices", [DevicesController::class, "listDevices"]],
    'device.edit'                           => ["POST", "/devices/edit/(.+)", [DevicesController::class, "editDevice"]],
    'device'                                => ["GET", "/devices/(.+)", [DevicesController::class, "deviceDetails"]]
];
