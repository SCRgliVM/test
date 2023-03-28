<?php

require_once __DIR__ . '/../vendor/autoload.php';

use core\App;

// Maybe add to .env
$dbConfig = [
    'user' => 'test',
    'password' => 'test'
];

$app = new App($dbConfig);

$app->router->get('/', [VisitorsController::class, 'get']);
$app->router->post('/', [VisitorsController::class, 'put']);

$app->router->get('/genres', [GenresController::class, 'get']);
$app->router->post('/genres', [GenresController::class, 'put']);

$app->router->get('/books', [BooksController::class, 'get']);
$app->router->post('/books', [BooksController::class, 'put']);

$app->router->get('/borrowing', [BorrowingController::class, 'get']);
$app->router->post('/borrowing', [BorrowingController::class, 'put']);

$app->render();

?>