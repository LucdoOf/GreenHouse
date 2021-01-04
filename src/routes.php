<?php

use GreenHouse\Controllers\DevicesController;
use GreenHouse\Controllers\HousesController;
use GreenHouse\Controllers\LoginController;

return [
    'login'         => ["GET", "/login", [LoginController::class, "login"]],
    'houses'        => ["GET", "/houses", [HousesController::class, "listHouses"]],
    'auth'          => ["POST", "/auth", [LoginController::class, "auth"]],
    'test'          => ["GET", "/test/(.+)/test/(.+)", [LoginController::class, "test"]],
    'logout'        => ["GET", "/logout", [LoginController::class, "logout"]],
    'devices'       => ["GET", "/devices", [DevicesController::class, "listDevices"]],
    'device.edit'   => ["POST", "/devices/edit/(.+)", [DevicesController::class, "editDevice"]],
    'device'        => ["GET", "/devices/(.+)", [DevicesController::class, "deviceDetails"]]
];
