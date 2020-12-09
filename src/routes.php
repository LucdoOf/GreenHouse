<?php

use GreenHouse\Controllers\LoginController;

return [
    '/'     => ["GET", "/", [LoginController::class, "login"]],
];
