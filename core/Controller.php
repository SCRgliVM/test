<?php

namespace core;
use src\views;
use core\App;

/**
 * Basic Controller class
 */
class Controller
{
    /**
     * Render view with given $params using main layout
     * @param string $view view to render
     * @param array $params params which view may use
     * 
     * @return string Render content
     */
    protected function renderView(string $view, array $params = [])
    {
        ob_start();
        include_once App::$ROOT_DIR.'views/layouts/main.php';
        return ob_get_clean();
    }
}

?>