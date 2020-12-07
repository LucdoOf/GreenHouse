<?php

namespace GreenHouse\Controllers;

use GreenHouse\Utils\Dbg;

class HomeController extends FrontController {

    public function home() {
        $this->render("home");
    }

}
