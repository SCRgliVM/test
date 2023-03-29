<?php

namespace src\controllers;
use core\Controller;
use core\Request;
use src\models\VisitorModel;

class VisitorsController extends Controller
{
    public function index()
    {
        $visitorModel = new VisitorModel();
        $visitors = $visitorModel->getAllVisitors();
        return $this->renderView('visitors/index', [
            'visitors' => $visitors,
        ]);
    }

    public function getCreateForm()
    {
        $visitorModel = new VisitorModel();
        return $this->renderView('visitors/create', [
            'visitorModel' => $visitorModel,
        ]);
    }

    public function create(Request $request)
    {
        $visitorModel = new VisitorModel();
        $visitorModel->load($request->getBody());
        if ($visitorModel->validate() && $visitorModel->createUser())
        {
            return 'Stub for processing correct POST in VisitorsController::create';
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