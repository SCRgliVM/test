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
     * @return string Render content
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
     * @return string Render Content
     */
    public function getCreateForm()
    {
        $visitorModel = new VisitorModel();
        return $this->renderView('visitors/create', [
            'visitorModel' => $visitorModel,
        ]);
    }

    /**
     * Try to add new visitor. If exist validation
     * errors then re-render creation form wih warnings
     * @param Request $request
     * @param Response $response
     * 
     * @return string Render content
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

    /**
     * Get editing form for visitor
     * @param Request $request
     * @param Response $response
     * @param string $id id of the visitor being edited
     * 
     * @return string Render content
     */
    public function getEditForm(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id)) 
            return (new NotFoundController())->index();

        $visitorModel = new VisitorModel();
        if (!$visitorModel->getById($id))
            return (new NotFoundController)->index();

        return $this->renderView('visitors/edit', [
            'visitorModel' => $visitorModel,
        ]);
    }

    /**
     * Try to edit visitor. If exist validation
     * errors then re-render creation form wih warnings
     * @param Request $request
     * @param Response $response
     * @param string $id id of the visitor being edited
     * 
     * @return string Render content
     */
    public function edit(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $visitorModel = new VisitorModel();
        $visitorModel->load($request->getBody());
        if ($visitorModel->validate() && $visitorModel->update($id)) {
            $response->redirectTo('/');
            return '';
        }

        return $this->renderView('visitors/edit', [
            'visitorModel' => $visitorModel,
        ]);
    }

    /**
     * Delete visitor
     * @param Request $request
     * @param Response $response
     * @param string $id id of the visitor being edited
     * 
     * @return string Render content
     */
    public function delete(Request $request, Response $response, string $id)
    {
        $id = (int)$id;
        if (!is_int($id))
            return (new NotFoundController())->index();

        $visitorModel = new VisitorModel();
        $visitorModel->delete($id);
        $response->redirectTo('/');
        return;
    }
}
