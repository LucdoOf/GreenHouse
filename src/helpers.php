<?php

/**
 * Retourne true si l'environnement est en mode développement
 *
 * @return bool
 */
function is_dev() {
    return IS_DEV;
}

/**
 * Retourne le domaine de l'application
 *
 * @return string
 */
function public_url() {
    return PUBLIC_DOMAIN . RELATIVE_DIR_PUBLIC;
}

/**
 * Retourne l'url d'un fichier de ressource public
 *
 * @param $type
 * @param $file
 * @return string
 */
function resource($type, $file) {
    return public_url() . "/assets/$type/$file";
}

/**
 * Retourne une route formatée récupérée parmis l'index des routes
 *
 * @param $route
 * @param string $var
 * @return string
 **/
function route($route, $var = null) {
    $routes = include('routes.php');

    if (isset($routes[$route][1])) {
        $uri = trim($routes[$route][1], '/');
    } else {
        $uri = $route;
    }

    $params = '';


    if (is_array($var)) {
        foreach ($var as $k => $v) {
            $count = 0;
            // On remplace les paramètres de la route par $var
            $uri = preg_replace('/\((?:[^)(]+|(?R))*+\)/', $v, $uri, 1, $count);
            if($count > 0) unset($var[$k]);
        }
        if (!empty($var)) {
            $params = http_build_query($var);
        }
    } else {
        $params = $var;
    }

    if (!empty($params) && strpos($uri, '?') === false && strpos($params, '?') === false) {
        $params = "?" . $params;
    }

    return public_url() . '/'.$uri . $params;
}

/**
 * Retourne l'URL appelé par le client
 *
 * @return string
 */
function get_called_url() {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
