<?php

namespace core;


/**
 * Working with the Response
 */
class Response
{

    /**
     * Redirect to route
     * @param mixed $route Route to redirect to
     * 
     * @return void
     */
    public function redirectTo($route)
    {
        header("Location: $route");
    }

    /**
     * Set response code
     * @param int $code Response code
     * 
     * @return void
     */
    public function setResponseCode(int $code)
    {
        http_response_code($code);
    }

}

?>