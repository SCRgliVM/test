<?php

namespace src\controllers;
use core\Controller;

class VisitorsController extends Controller
{
    public function get()
    {
        return $this->renderView('visitors/index');
    }
    public function put()
    {
        echo 'Stub for put in VisitorsController';
    }
}

?>