<?php

use GreenHouse\Controllers\HousesController;
use GreenHouse\Controllers\LoginController;

return [
    '/'         => ["GET", "/", [LoginController::class, "login"]],
    'houses'    => ["GET", "/houses", [HousesController::class, "listHouses"]]
];
