<?php

use GreenHouse\Controllers\ConfigurationController;
use GreenHouse\Controllers\HousesController;
use GreenHouse\Controllers\LoginController;

return [
    'login'                             => ["GET", "/login", [LoginController::class, "login"]],
    'houses'                            => ["GET", "/houses", [HousesController::class, "listHouses"]],
    'auth'                              => ["POST", "/auth", [LoginController::class, "auth"]],
    'test'                              => ["GET", "/test/(.+)/test/(.+)", [LoginController::class, "test"]],
    'logout'                            => ["GET", "/logout", [LoginController::class, "logout"]],
    'configuration.zones'               => ["GET", "/configuration/zones", [ConfigurationController::class, "listZones"]],
    'configuration.regions.create'      => ["POST", "/configuration/zones/regions/create", [ConfigurationController::class, "createRegion"]],
    'configuration.departments.create'  => ["POST", "/configuration/zones/regions/(.+)/departments/create", [ConfigurationController::class, "createDepartment"]],
    'configuration.cities.create'       => ["POST", "/configuration/zones/departments/(.+)/cities/create", [ConfigurationController::class, "createCity"]]
];
