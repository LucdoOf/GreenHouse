<?php

use GreenHouse\Controllers\FrontController;
use GreenHouse\Controllers\Router;

require '../src/boot.php';
$router = new Router(include APPLICATION_PATH . '/src/routes.php', RELATIVE_DIR_PUBLIC, FrontController::class);
$router->routeReq();
