<?php

use GreenHouse\Controllers\ConfigurationController;
use GreenHouse\Controllers\DevicesController;
use GreenHouse\Controllers\HousesController;
use GreenHouse\Controllers\FlatsController;
use GreenHouse\Controllers\LoginController;

return [
    'login'     => ["GET", "/login", [LoginController::class, "login"]],
    'houses'    => ["GET", "/houses", [HousesController::class, "listHouses"]],
    'house.edit'=> ["POST", "/houses/edit/(.+)", [HousesController::class, "editHouse"]],
    'house'     => ["GET", "/houses/(.+)", [HousesController::class, "houseDetails"]],
    'flats'    => ["GET", "/flats", [FlatsController::class, "listFlats"]],
    'flat.edit'=> ["POST", "/flat/edit/(.+)", [FlatsController::class, "editFlat"]],
    'flat'     => ["GET", "/flat/(.+)", [FlatsController::class, "flatDetails"]],
    'rooms'    => ["GET", "/rooms", [RoomsController::class, "listRooms"]],
    'room.edit'=> ["POST", "/room/edit/(.+)", [RoomsController::class, "editRoom"]],
    'room'     => ["GET", "/room/(.+)", [RoomsController::class, "roomDetails"]],
    'auth'      => ["POST", "/auth", [LoginController::class, "auth"]],
    'test'      => ["GET", "/test/(.+)/test/(.+)", [LoginController::class, "test"]],
    'logout'    => ["GET", "/logout", [LoginController::class, "logout"]],
    'configuration'               => ["GET", "/configuration", [ConfigurationController::class, "configuration"]],
    'configuration.types.create'        => ["POST", "/configuration/types/create", [ConfigurationController::class, "createType"]],
    'configuration.regions.create'      => ["POST", "/configuration/zones/regions/create", [ConfigurationController::class, "createRegion"]],
    'configuration.departments.create'  => ["POST", "/configuration/zones/regions/(.+)/departments/create", [ConfigurationController::class, "createDepartment"]],
    'configuration.cities.create'       => ["POST", "/configuration/zones/departments/(.+)/cities/create", [ConfigurationController::class, "createCity"]],
    'devices'       => ["GET", "/devices", [DevicesController::class, "listDevices"]],
    'device.edit'   => ["POST", "/devices/edit/(.+)", [DevicesController::class, "editDevice"]],
    'device'        => ["GET", "/devices/(.+)", [DevicesController::class, "deviceDetails"]]
];
