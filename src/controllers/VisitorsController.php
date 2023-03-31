<?php

namespace src\controllers;

use core\Controller;
use core\Request;
use core\Response;
use src\models\VisitorModel;
use src\controllers\NotFoundController;

/**
 * CRUD for visitors page
 */
class VisitorsController extends Controller
{
    /**
     * Rendex visitors list
     * @return string
     */
    public function index()
    {
        $visitorModel = new VisitorModel();
        $visitors = $visitorModel->getAll();
        return $this->renderView('visitors/index', [
            'visitors' => $visitors,
        ]);
    }

    /**
     * Render form for creating new visitor
     * @return [type]
     */
    public function getCreateForm()
    {
        $visitorModel = new VisitorModel();
        return $this->renderView('visitors/create', [
            'visitorModel' => $visitorModel,
        ]);
    }

    /**
     * Add new visitor
     * @param Request $request
     * @param Response $response
     * 
     * @return string
     */
    public function create(Request $request, Response $response)
    {
        $visitorModel = new VisitorModel();
        $visitorModel->load($request->getBody());
        if ($visitorModel->validate() && $visitorModel->create()) {
            $response->redirectTo('/');
            return '';
        }
        return $this->renderView('visitors/create', [
            'visitorModel' => $visitorModel,
        ]);
    }

    public function getEditForm(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id)) 
            return (new NotFoundController())->index();

        $visitorModel = new VisitorModel();
        if (!$visitorModel->getVisitorById($id))
            return (new NotFoundController)->index();

        return $this->renderView('visitors/edit', [
            'visitorModel' => $visitorModel,
        ]);
    }

    public function edit(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $visitorModel = new VisitorModel();
        $visitorModel->load($request->getBody());
        if ($visitorModel->validate() && $visitorModel->updateVisitor($id)) {
            $response->redirectTo('/');
            return '';
        }

        return $this->renderView('visitors/edit', [
            'visitorModel' => $visitorModel,
        ]);
    }

    public function delete(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $visitorModel = new VisitorModel();
        $visitorModel->deleteVisitor($id);
        $response->redirectTo('/');
        return;
    }
}
