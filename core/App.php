<?php

namespace core;

use core\Router;
use core\Request;
use core\Database;

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
        $this->router = new Router($this->request);
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
            var_dump($exception);
            exit;
        }
    }
}
