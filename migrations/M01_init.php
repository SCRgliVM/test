<?php

use core\Database;

class M01_init
{
    public function up()
    {
        $VisitorsSQL = "CREATE TABLE IF NOT EXISTS visitors (
                id INT AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(20) NOT NULL
            )  ENGINE=INNODB;";
        $GenresSQL = "CREATE TABLE IF NOT EXISTS genres (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL
            )  ENGINE=INNODB;";
        $BooksSQL = "CREATE TABLE IF NOT EXISTS books (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            author VARCHAR(255) NOT NULL,
            release_year INT NOT NULL,
            genre_id INT NOT NULL,
            FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE
            )  ENGINE=INNODB;";
        $SQL = $VisitorsSQL.$GenresSQL.$BooksSQL;
        Database::$DB->pdo->exec($SQL);
    }
}
