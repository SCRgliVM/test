<?php

namespace src\controllers;

use core\Controller;

/**
 * Controller for unknown routes
 */
class NotFoundController extends Controller
{

    /**
     * Render 404 page
     * @return string Render content for 404 page
     */
    public function index()
    {
        return $this->renderView('notFound');
    }

}

?>