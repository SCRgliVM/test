<?php

namespace src\models;

use core\Model;
use core\default\CRUDModel;
use core\Database;
use src\models\GenreModel;

class BookModel extends CRUDModel
{
    public string $title = '';
    public string $author = '';
    public string $release_year = '';
    public string $genre = '';

    public string $id = '';

    public function validationRules()
    {
        return [
            'title'        => [self::RULE_REQUIRED],
            'author'       => [self::RULE_REQUIRED],
            'release_year' => [self::RULE_REQUIRED, self::RULE_YEAR, self::RULE_MAX_YEAR],
            'genre'        => [self::RULE_REQUIRED],
        ];
    }

    protected function getSelectAllQuery(): string {
        return 'SELECT b.*, g.name AS genre_name 
                FROM books b
                INNER JOIN genres g ON b.genre_id = g.id';
    }

    protected function getCreateStatement(): string
    {
        $genreModel = new GenreModel();
        $genre_id = $genreModel->getGenreIdByName($this->genre)['id'] ?? false;
        if (!$genre_id) {
            $genreModel->name = $this->genre;
            $genreModel->create();
            $genre_id = $genreModel->getGenreIdByName($this->genre)['id'];
        }
        
        return "INSERT INTO books (title, author, release_year, genre_id) 
                VALUES ('$this->title', '$this->author', '$this->release_year', $genre_id)";
    }

    protected function getSelectByIdQuery(int $id) : string
    {
        return "SELECT b.*, g.name AS genre
                FROM books b
                INNER JOIN genres g ON b.genre_id = g.id
                WHERE b.id=$id";
    }

    protected function getUpdateStatement(int $id) : string
    {
        $genreModel = new GenreModel();
        $genre_id = $genreModel->getGenreIdByName($this->genre)['id'] ?? false;
        if (!$genre_id) {
            $genreModel->name = $this->genre;
            $genreModel->create();
            $genre_id = $genreModel->getGenreIdByName($this->genre)['id'];
        }

        return "UPDATE books
                SET title        = '$this->title',
                    author       = '$this->author',
                    release_year = '$this->release_year',
                    genre_id     = $genre_id
                WHERE id = $id;";
    }

    protected function getColumnToFieldMap() : array
    {
        return [
            'title'        => 'title',
            'author'       => 'author',
            'email'        => 'email',
            'release_year' => 'release_year',
            'genre'        => 'genre',
            'id'           => 'id',
        ];
    }

    public function deleteBook($id)
    {
        return Database::$DB->pdo
            ->prepare("DELETE FROM books
                       WHERE id = $id")
            ->execute();
    }

}
