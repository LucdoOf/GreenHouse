<?php

namespace GreenHouse\Core;

class Request {

    public static function valuePost($k, $default = null, $noempty = false) {
        if(empty($_POST)) {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
        return isset($_POST[$k]) && (!$noempty || ((!empty(trim($_POST[$k])) || $_POST[$k] === "0"))) ? $_POST[$k] : $default;
    }

    public static function valueRequest($k, $default = null, $notempty = false) {
        return isset($_REQUEST[$k]) && (!$notempty || ((!empty(trim($_REQUEST[$k])) || $_REQUEST[$k] === "0"))) ? $_REQUEST[$k] : $default;
    }

    public static function valueSession($k, $default = null, $notempty = false) {
        return isset($_SESSION[$k]) && (!$notempty || ((!empty(trim($_SESSION[$k])) || $_SESSION[$k] === "0"))) ? $_SESSION[$k] : $default;
    }

}
