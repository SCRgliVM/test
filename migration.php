<?php

use core\Database;

include_once __DIR__.'/vendor/autoload.php';

$dbConfig = [
    'dsn' => 'mysql:host=db;port=3306;dbname=test',
    'user' => 'test',
    'password' => 'test'
];

$DB = new Database($dbConfig);

$DB->migration(__DIR__);

?>