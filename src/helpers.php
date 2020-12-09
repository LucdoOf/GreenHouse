<?php

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
        $kfound = 0;
        foreach ($var as $k => $v) {
            $prevKFound = $kfound;
            // On remplace les paramètres de la route par $var
            $uri = preg_replace('/\{' . $k . ':?(.*)?\}/', $v, $uri, -1, $kfound);
            if ($kfound > $prevKFound) {
                unset($var[$k]);
            }
        }
        if (!empty($var)) {
            $params = http_build_query($var);
        }
    } elseif (intval($var) > 0) {
        $uri = preg_replace('/\{id:(.*)\}/', $var, $uri);
    } else {
        $params = $var;
    }

    if (!empty($params) && strpos($uri, '?') === false && strpos($params, '?') === false) {
        $params = "?" . $params;
    }

    return public_url() . $uri . $params;
}
