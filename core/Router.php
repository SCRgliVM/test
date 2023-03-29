<?php

namespace core;

use core\Request;
use core\Response;
use src\controllers\NotFoundController;

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
     * @var Response
     */
    private Response $response;

    /**
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
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

        // If unknown route - render 404 page
        if ($controllerCallback === false){
            $controllerCallback = [NotFoundController::class, 'index'];
        }
        
        $controller = new $controllerCallback[0];
        $controllerCallback[0] = $controller;
        return call_user_func($controllerCallback, $this->request, $this->response);

    }
}

?>