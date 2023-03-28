<?php

namespace src\controllers;
use core\Controller;

class BooksController extends Controller
{
    public function get()
    {
        return $this->renderView('books/index');
    }
    public function put()
    {
        echo 'Stub for put in BooksController';
    }
}

?>