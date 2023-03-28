<?php

namespace src\controllers;
use core\Controller;

class BorrowingController extends Controller
{
    public function get()
    {
        return $this->renderView('borrowing/index');
    }
    public function put()
    {
        echo 'Stub for put in BorrowingController';
    }
}

?>