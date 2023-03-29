<?php

namespace src\controllers;
use core\Controller;

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
        return $this->renderView('visitors/index', $visitors);
    }
    public function put()
    {
        echo 'Stub for put in VisitorsController';
    }
    public function add()
    {
        return $this->renderView('visitors/create');
    }
    public function edit()
    {
        
    }
}

?>