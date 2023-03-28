<?php

namespace src\controllers;
use core\Controller;

class GenresController extends Controller
{
    public function get()
    {
        return $this->renderView('genres/index');
    }
    public function put()
    {
        echo 'Stub for put in GenresController';
    }
}

?>