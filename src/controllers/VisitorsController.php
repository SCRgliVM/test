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
        if ($visitorModel->validate() && $visitorModel->createVisitor())
        {
            $response->redirectTo('/');
            return '';
        }
        return $this->renderView('visitors/create', [
            'visitorModel' => $visitorModel,
        ]);
    }

    public function getEditForm()
    {
        return 'Stub for getEditForm in VisitorsController';
    }

    public function edit()
    {
        return 'Stub for edit in VisitorsController';
    }
}

?>