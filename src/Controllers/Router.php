<?php

namespace GreenHouse\Controllers;

use GreenHouse\Utils\Dbg;
use Exception;
use function FastRoute\cachedDispatcher;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

class Router {

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
        Dbg::logs($routes);
        $dispatcher = cachedDispatcher(function (RouteCollector $r) use ($routes) {
            $dir = ($this->relativeDir ? $this->relativeDir : '');
            foreach ($routes as $routeId => $rt) {
                $r->addRoute($rt[0], $dir . $rt[1], [$rt[2], $routeId]);
            }
        }, [
            'cacheFile'     => APPLICATION_PATH . '/data/cache/routes_public.cache',
            'cacheDisabled' => IS_DEV,
        ]);

        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                if (IS_DEV) {
                    Dbg::error('Route not found ' . $uri);
                }
                (new $this->controllerClass())->error_404();
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                Dbg::error('Method not allowed');
                (new $this->controllerClass())->error_405();
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                list($controller, $method) = $handler[0];
                $routeId = $handler[1];

                //La clé API a été renseignée
                if (method_exists($controller, $method)) {
                    call_user_func_array([new $controller, $method], $vars);
                } else {
                    Dbg::error("Method $method not found");
                    (new Controller())->error_404();
                }
                break;
            default:
                (new $this->controllerClass())->error_404();
                break;
        }
    }
}
