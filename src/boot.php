<?php

use GreenHouse\Utils\Dbg;

define('APPLICATION_PATH', realpath(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR));
require_once(APPLICATION_PATH . "/vendor/autoload.php");

ini_set('log_errors', 1);
ini_set('error_log', Dbg::getFileName());

require_once(APPLICATION_PATH . "/conf.inc.php");

require_once ("helpers.php");
