<?php

namespace GreenHouse\Controllers;

use GreenHouse\Utils\Dbg;

class Router {

    const ROUTE_NOT_FOUND = 0;
    const ROUTE_METHOD_NOT_ALLOWED = 1;
    const ROUTE_FOUND = 2;

    private $routes;
    private $relativeDir;
    private $controllerClass;

    public function __construct($routes, $relativeDir, $controllerClass){
        $this->routes = $routes;
        $this->relativeDir = $relativeDir;
        $this->controllerClass = $controllerClass;
    }

    /**
     * Retourne la liste des routes
     * @return array
     */
    public function getRoutes(){
        return $this->routes;
    }

    /**
     * Recherche un controller et une action à effectuer
     */
    public function routeReq(){
        $routes = $this->getRoutes();

        $routeInfo = [
            "status"    => self::ROUTE_NOT_FOUND,
            "vars"      => [],
            "handler"   => [
                "controller" => null,
                "method" => null
            ],
        ];

        $uri = substr($_SERVER['REQUEST_URI'], strlen(RELATIVE_DIR_PUBLIC));
        // On enlève les paramètres et on enlève tout ce qu'il y a avant RELATIVE_DIR_PUBLIC
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        if($uri[strlen($uri)-1] == '/') $uri = substr($uri, 0, strlen($uri)-1);

        // On cherche la route depuis l'URL
        foreach ($routes as $routeId => $routeData) {
            $routeMethod = $routeData[0];
            // On construit la regex
            $routeRegex = "/^" . str_replace("/", "\/", $routeData[1]) . "$/";
            $routeHandler = $routeData[2];
            $matches = [];
            if (preg_match($routeRegex, $uri, $matches)) {
                if ($_SERVER["REQUEST_METHOD"] == $routeMethod) {
                    $routeInfo["status"] = self::ROUTE_FOUND;
                    $routeInfo["handler"]["controller"] = $routeHandler[0];
                    $routeInfo["handler"]["method"] = $routeHandler[1];
                    unset($matches[0]); // Le premier élément de matches correspond à l'URL entière
                    $routeInfo["vars"] = $matches;
                } else {
                    Dbg::error($_SERVER["REQUEST_METHOD"]." ".$routeMethod." ".$routeId);
                    $routeInfo["status"] = self::ROUTE_METHOD_NOT_ALLOWED;
                }
                break;
            }
        }

        switch ($routeInfo["status"]) {
            case self::ROUTE_NOT_FOUND:
                if (IS_DEV) {
                    Dbg::error('Route not found ' . get_called_url());
                }
                (new $this->controllerClass())->error_404();
                break;
            case self::ROUTE_METHOD_NOT_ALLOWED:
                Dbg::error('Method not allowed');
                (new $this->controllerClass())->error_405();
                break;
            case self::ROUTE_FOUND:
                $handler = $routeInfo["handler"];
                $vars = $routeInfo["vars"];
                $controller = $handler["controller"];
                $method = $handler["method"];

                if (method_exists($controller, $method)) {
                    Dbg::success("Found route " . $method . ":" . $controller);
                    call_user_func_array([new $controller, $method], $vars);
                } else {
                    Dbg::error("Method $method not found");
                    (new Controller())->error_404();
                }
                break;
        }
    }
}
