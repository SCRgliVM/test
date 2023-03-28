<?php

namespace core;

use core\Request;

/**
 * Router class which resolve current route
 */
class Router
{
    /**
     * @var array Two-dimensional array where controllers methods are registered
     */
    private array $routesMap = [];


    /**
     * @var Request
     */
    private Request $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $route - The route where the controller method is registered
     * @param mixed $controllerCallback - The representation of the controller method
     * 
     * @return $this for chaining
     */
    public function get(string $route, $controllerCallback)
    {
        $this->routesMap['get'][$route] = $controllerCallback;
        return $this;
    }

    /**
     * @param string $route - The route where the controller method is registered
     * @param mixed $controllerCallback - The representation of the controller method
     * 
     * @return $this for chaining
     */
    public function post(string $route, $controllerCallback)
    {
        $this->routesMap['post'][$route] = $controllerCallback;
    }


    /**
     * Resolve route and attached to it registered controller method
     * @return string Render content
     */
    public function resolveRoute()
    {
        $method= $this->request->getRequestMethod();
        $route  = $this->request->getRoute();
        $controllerCallback = $this->routesMap[$method][$route] ?? false;

        if ($controllerCallback === false){
            return 'Stub for 404 page';
        }

        return 'Stub for resolved route';
    }
}

?>