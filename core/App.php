<?php

namespace core;

use core\Router;
use core\Request;
use core\Response;
use core\Database;

/**
 * Core app class
 */
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
     * @var Response
     */
    public Response $response;

    /**
     * @var string Root directory for app files
     */
    public static string $ROOT_DIR;

    public static Database $DB;

    /**
     * @param mixed $dbConfig Configuration for database
     */
    public function __construct($dbConfig, $srcPath)
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        self::$ROOT_DIR = $srcPath;

        self::$DB = new Database($dbConfig);
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
            echo '<pre>';
            var_dump($exception);
            echo '</pre>';
            exit;
        }
    }
}
