<?php

namespace src\controllers;

use core\Controller;
use core\Request;
use core\Response;
use src\models\VisitorModel;

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
        $visitors = $visitorModel->getAllVisitors();
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
        if ($visitorModel->validate() && $visitorModel->createVisitor()) {
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
        if (!is_int($id)) {
            return 'Id is not valid in VisitorController::getEditForm';
        }
        $visitorModel = new VisitorModel();
        $visitorModel->getVisitorById($id);
        return $this->renderView('visitors/edit', [
            'visitorModel' => $visitorModel,
        ]);
    }

    public function edit(Request $request, Response $response, string $id)
    {
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
}
