<?php

namespace src\controllers;
use core\Controller;
use core\Request;
use core\Response;
use src\models\BookModel;

/**
 * Controller for book page
 */
class BooksController extends Controller
{
    /**
     * Index page
     * @return string Render content
     */
    public function index()
    {
        $bookModel = new BookModel();
        $books = $bookModel->getAll();
        return $this->renderView('books/index', [
            'books' => $books,
        ]);
    }

    /**
     * Get create form for creating new book
     * @return string Render content
     */
    public function getCreateForm()
    {
        $bookModel = new BookModel();
        return $this->renderView('books/create', [
            'bookModel' => $bookModel,
        ]);
    }

    /**
     * Try to create new book. If exist validation
     * errors then re-render creation form wih warnings
     * @param Request $request
     * @param Response $response
     * 
     * @return string Render content
     */
    public function create(Request $request, Response $response)
    {
        $bookModel = new BookModel();
        $bookModel->load($request->getBody());

        if ($bookModel->validate() && $bookModel->create()) {
            $response->redirectTo('/books');
            return '';
        }
        return $this->renderView('books/create', [
            'bookModel' => $bookModel,
        ]);
    }

    /**
     * Get editing form for given book
     * @param Request $request
     * @param Response $response
     * @param string $id id of the book being edited
     * 
     * @return string Render content
     */
    public function getEditForm(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id)) 
            return (new NotFoundController())->index();

        $bookModel = new BookModel();
        if (!$bookModel->getById($id))
            return (new NotFoundController)->index();

        return $this->renderView('books/edit', [
            'bookModel' => $bookModel,
        ]);
    }

    /**
     * Try to edit book. If exist validation
     * errors then re-render creation form wih warnings
     * @param Request $request
     * @param Response $response
     * @param string $id id of the book beign edited
     * 
     * @return string Render content
     */
    public function edit(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $bookModel = new BookModel();
        $bookModel->load($request->getBody());
        if ($bookModel->validate() && $bookModel->update($id)) {
            $response->redirectTo('/books');
            return '';
        }

        return $this->renderView('books/edit', [
            'bookModel' => $bookModel,
        ]);
    }

    /**
     * Delete book
     * @param Request $request
     * @param Response $response
     * @param string $id id of book beign deleted
     * 
     * @return void
     */
    public function delete(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $bookModel = new BookModel();
        $bookModel->delete($id);
        $response->redirectTo('/books');
        return;
    }

}

?>