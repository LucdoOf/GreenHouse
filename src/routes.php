<?php

use GreenHouse\Controllers\HousesController;
use GreenHouse\Controllers\LoginController;

return [
    'login'     => ["GET", "/login", [LoginController::class, "login"]],
    'houses'    => ["GET", "/houses", [HousesController::class, "listHouses"]],
    'auth'      => ["POST", "/auth", [LoginController::class, "auth"]]
];
