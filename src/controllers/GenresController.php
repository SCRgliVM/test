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
    public function index()
    {
        $genreModel = new GenreModel();
        $genres = $genreModel->getAll();
        return $this->renderView('genres/index', [
            'genres' => $genres
        ]);
    }
    
    public function getCreateForm()
    {
        $genreModel = new GenreModel();
        return $this->renderView('genres/create', [
            'genreModel' => $genreModel,
        ]);
    }

    public function create(Request $request, Response $response)
    {
        $genreModel = new GenreModel();
        $genreModel->load($request->getBody());
        if ($genreModel->validate() && $genreModel->createGenre()) {
            $response->redirectTo('/genres');
            return '';
        }
        return $this->renderView('genres/create', [
            'genreModel' => $genreModel,
        ]);
    }

    public function getEditForm(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id)) 
            return (new NotFoundController())->index();

        $genreModel = new GenreModel();
        if (!$genreModel->getGenreById($id))
            return (new NotFoundController)->index();

        return $this->renderView('genres/edit', [
            'genreModel' => $genreModel,
        ]);
    }

    public function edit(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $genreModel = new GenreModel();
        $genreModel->load($request->getBody());
        if ($genreModel->validate() && $genreModel->updateGenre($id)) {
            $response->redirectTo('/genres');
            return '';
        }

        return $this->renderView('genres/edit', [
            'genreModel' => $genreModel,
        ]);
    }

    public function delete(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $genreModel = new GenreModel();
        $genreModel->deleteGenre($id);
        $response->redirectTo('/genres');
        return;
    }

}

?>