<?php

namespace core;
use src\views;
use core\App;

class Controller
{
    protected function renderView(string $view, array $params = [])
    {
        ob_start();
        include_once App::$ROOT_DIR."views/$view.php";
        return ob_get_clean();
    }
}

?>