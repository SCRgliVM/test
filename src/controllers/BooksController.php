<?php

namespace src\controllers;
use core\Controller;
use core\Request;
use core\Response;
use src\models\BookModel;

class BooksController extends Controller
{
    public function index()
    {
        $bookModel = new BookModel();
        $books = $bookModel->getAllBooks();
        return $this->renderView('books/index', [
            'books' => $books,
        ]);
    }

    public function getCreateForm()
    {
        $bookModel = new BookModel();
        return $this->renderView('books/create', [
            'bookModel' => $bookModel,
        ]);
    }

    public function create(Request $request, Response $response)
    {
        $bookModel = new BookModel();
        $bookModel->load($request->getBody());

        if ($bookModel->validate() && $bookModel->createBook()) {
            $response->redirectTo('/books');
            return '';
        }
        return $this->renderView('books/create', [
            'bookModel' => $bookModel,
        ]);
    }

    public function getEditForm(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id)) 
            return (new NotFoundController())->index();

        $bookModel = new BookModel();
        if (!$bookModel->getBookById($id))
            return (new NotFoundController)->index();

        return $this->renderView('books/edit', [
            'bookModel' => $bookModel,
        ]);
    }

    public function edit(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $bookModel = new BookModel();
        $bookModel->load($request->getBody());
        if ($bookModel->validate() && $bookModel->updateBook($id)) {
            $response->redirectTo('/books');
            return '';
        }

        return $this->renderView('books/edit', [
            'bookModel' => $bookModel,
        ]);
    }

    public function delete(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $bookModel = new BookModel();
        $bookModel->deleteBook($id);
        $response->redirectTo('/books');
        return;
    }

}

?>