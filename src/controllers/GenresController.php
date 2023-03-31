<?php

namespace src\controllers;

use core\Controller;
use core\Request;
use core\Response;

use src\models\GenreModel;

/**
 * Controler for genre page
 */
class GenresController extends Controller
{
    /**
     * Index page
     * @return string Render content
     */
    public function index()
    {
        $genreModel = new GenreModel();
        $genres = $genreModel->getAll();
        return $this->renderView('genres/index', [
            'genres' => $genres
        ]);
    }
    
    /**
     * Get creating form for genre
     * @return string Render content
     */
    public function getCreateForm()
    {
        $genreModel = new GenreModel();
        return $this->renderView('genres/create', [
            'genreModel' => $genreModel,
        ]);
    }

    /**
     * Try to create genre. If exist validation
     * errors then re-render creation form wih warnings
     * @param Request $request
     * @param Response $response
     * 
     * @return string Render content
     */
    public function create(Request $request, Response $response)
    {
        $genreModel = new GenreModel();
        $genreModel->load($request->getBody());
        if ($genreModel->validate() && $genreModel->create()) {
            $response->redirectTo('/genres');
            return '';
        }
        return $this->renderView('genres/create', [
            'genreModel' => $genreModel,
        ]);
    }

    /**
     * Get editing form for genre
     * @param Request $request
     * @param Response $response
     * @param string $id id of the genre being edited
     * 
     * @return string Render content
     */
    public function getEditForm(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id)) 
            return (new NotFoundController())->index();

        $genreModel = new GenreModel();
        if (!$genreModel->getById($id))
            return (new NotFoundController)->index();

        return $this->renderView('genres/edit', [
            'genreModel' => $genreModel,
        ]);
    }

    /**
     * Try to edit genre. If exist validation
     * errors then re-render creation form wih warnings
     * @param Request $request
     * @param Response $response
     * @param string $id id of the genre being edited
     * 
     * @return string Render content
     */
    public function edit(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $genreModel = new GenreModel();
        $genreModel->load($request->getBody());
        if ($genreModel->validate() && $genreModel->update($id)) {
            $response->redirectTo('/genres');
            return '';
        }

        return $this->renderView('genres/edit', [
            'genreModel' => $genreModel,
        ]);
    }

    /**
     * Delete genre
     * @param Request $request
     * @param Response $response
     * @param string $id id of the genre being deleted
     * 
     * @return string Render content
     */
    public function delete(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $genreModel = new GenreModel();
        $genreModel->delete($id);
        $response->redirectTo('/genres');
        return;
    }

}

?>