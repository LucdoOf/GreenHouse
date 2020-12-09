<?php

use GreenHouse\Controllers\HomeController;

return [
    '/'     => ["GET", "/", [HomeController::class, "home"]],
];
