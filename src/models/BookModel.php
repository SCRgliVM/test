<?php

namespace src\controllers;

use core\Model;
use core\Database;

class BookModel extends Model
{
    public string $title = '';
    public string $author = '';
    public string $email = '';
    public string $phone = '';

    public string $id = '';
}

?>