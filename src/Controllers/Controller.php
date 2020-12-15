<?php

namespace GreenHouse\Controllers;

class Controller {

    protected $user = null;
    const REQUIRE_AUTH = false;

    public function __construct() {}

    public function error_403() {
        header('HTTP/1.0 403 Forbidden');
    }

    public function error_404() {
        header('HTTP/1.0 404 Not Found');
    }

    public function error_401() {
        header('HTTP/1.0 401 Unauthorized');
    }

    public function error_405() {
        header('HTTP/1.0 405 Method not allowed');
    }

}
