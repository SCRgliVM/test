<?php

namespace core;

class Response
{

    public function redirectTo($route)
    {
        header("Location: $route");
    }
    
}

?>