<?php

require_once __DIR__ . '/../vendor/autoload.php';

use core\App;
use src\controllers\VisitorsController;
use src\controllers\GenresController;
use src\controllers\BooksController;
use src\controllers\BorrowingController;


$dbConfig = [
    'dsn' => 'mysql:host=db;port=3306;dbname=test',
    'user' => 'test',
    'password' => 'test'
];

$app = new App($dbConfig, dirname(__DIR__)."/src/");

$app->router->get('/', [VisitorsController::class, 'index']);
$app->router->get('/visitors/add', [VisitorsController::class, 'getCreateForm']);
$app->router->post('/visitors/add', [VisitorsController::class, 'create']);

// TODO:
//$app->router->get('/visitors/edit/{id}', [VisitorsController::class, 'getEditForm']);
//$app->router->post('/visitors/edit/{id}', [VisitorsController::class, 'edit']);

$app->router->get('/genres', [GenresController::class, 'get']);
$app->router->post('/genres', [GenresController::class, 'put']);

$app->router->get('/books', [BooksController::class, 'get']);
$app->router->post('/books', [BooksController::class, 'put']);

$app->router->get('/borrowing', [BorrowingController::class, 'get']);
$app->router->post('/borrowing', [BorrowingController::class, 'put']);

$app->render();

?>