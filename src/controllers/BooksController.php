<?php

namespace src\controllers;
use core\Controller;
use src\models\BookModel;

class BooksController extends Controller
{
    public function index()
    {
        //$bookModel = new BookModel();
        //$books = $bookModel->getAllBooks();
        return $this->renderView('books/index', [
            'books' => [],
        ]);
    }
    public function put()
    {
        echo 'Stub for put in BooksController';
    }
}

?>