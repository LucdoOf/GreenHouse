<?php

use GreenHouse\Controllers\HomeController;

return [
    '/'     => ["GET", "/home", [HomeController::class, "home"]],
];
