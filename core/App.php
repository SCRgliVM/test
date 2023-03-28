<?php

namespace core;

use core\Router;
use core\Request;

class App
{
    /**
     * @var Router
     */
    public Router $router;

    /**
     * @var Request
     */
    public Request $request;

    /**
     * @param mixed $dbConfig Configuration for database
     */
    public function __construct($dbConfig)
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    /**
     * Trigger rendering
     * @return void
     */
    public function render()
    {
        try {
            echo $this->router->resolveRoute();
        } catch (\Exception $exception) {
            var_dump($exception);
            exit;
        }
    }
}
