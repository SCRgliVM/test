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
$app->router->get('/visitors/edit/{id}', [VisitorsController::class, 'getEditForm']);
$app->router->post('/visitors/edit/{id}', [VisitorsController::class, 'edit']);
$app->router->get('/visitors/delete/{id}', [VisitorsController::class, 'delete']);

$app->router->get('/genres', [GenresController::class, 'index']);
$app->router->get('/genres/add', [GenresController::class, 'getCreateForm']);
$app->router->post('/genres/add', [GenresController::class, 'create']);
$app->router->get('/genres/edit/{id}', [GenresController::class, 'getEditForm']);
$app->router->post('/genres/edit/{id}', [GenresController::class, 'edit']);
$app->router->get('/genres/delete/{id}', [GenresController::class, 'delete']);

$app->router->get('/books', [BooksController::class, 'index']);
$app->router->get('/books/add', [BooksController::class, 'getCreateForm']);
$app->router->post('/books/add', [BooksController::class, 'create']);
$app->router->get('/books/edit/{id}', [BooksController::class, 'getEditForm']);
$app->router->post('/books/edit/{id}', [BooksController::class, 'edit']);
$app->router->get('/books/delete/{id}', [BooksController::class, 'delete']);


$app->router->get('/borrowing', [BorrowingController::class, 'get']);
$app->router->post('/borrowing', [BorrowingController::class, 'put']);

$app->render();

?>