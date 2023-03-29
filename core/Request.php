<?php

namespace core;

/**
 * Provide info about current request
 */
class Request
{
    /**
     * Get current request method
     * @return string Current request method
     */
    public function getRequestMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Get current route
     * @return string Current route
     */
    public function getRoute()
    {
        $route = $_SERVER['REQUEST_URI'];
        $queryPosition = strpos($route, '?');
        if ($queryPosition !== false) {
            $route = substr($route, 0, $queryPosition);
        }
        return $route;
    }

    /**
     * Get POST body
     * @return array Associative array with body content
     */
    public function getBody()
    {
        $payload = [];
        foreach ($_POST as $key => $value) {
            $payload[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $payload;
    }

}

?>