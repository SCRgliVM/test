<?php

namespace src\controllers;
use core\Controller;
use core\Request;
use src\models\VisitorModel;

class VisitorsController extends Controller
{
    public function index()
    {
        // Test suits
        $visitors = [
            [
                'id'        => 1,
                'firstName' => 'Gohd',
                'lastName'  => 'Grub',
                'email'     => 'grub@example.com',
                'phone'     => '0951234455'
            ],
            [
                'id'        => 2,
                'firstName' => 'Dhodl',
                'lastName'  => 'Bruhd',
                'email'     => 'bruhd@example.com',
                'phone'     => '0991444115'
            ]
        ];
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
        if (!$visitorModel->validate())
        {
            return $this->renderView('visitors/create', [
                'visitorModel' => $visitorModel,
            ]);
        }
        return 'Stub for processing correct POST in VisitorsController::create';
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