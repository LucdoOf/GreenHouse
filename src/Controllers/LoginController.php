<?php

namespace GreenHouse\Controllers;

use GreenHouse\Utils\Dbg;

class LoginController extends FrontController {

    protected $layout = "login";

    public function login() {
        $this->render("login");
    }

}
