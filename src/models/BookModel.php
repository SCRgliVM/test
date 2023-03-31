<?php

namespace src\models;

use core\Model;
use core\Database;
use src\models\GenreModel;

class BookModel extends Model
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

    public function getAllBooks()
    {
        return Database::$DB->pdo
            ->query('SELECT b.*, g.name AS genre_name 
                     FROM books b
                     INNER JOIN genres g ON b.genre_id = g.id')
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createBook()
    {
        $genreModel = new GenreModel();
        $genre_id = $genreModel->getGenreIdByName($this->genre)['id'] ?? false;
        if (!$genre_id) {
            $genreModel->name = $this->genre;
            $genreModel->createGenre();
            $genre_id = $genreModel->getGenreIdByName($this->genre)['id'];
        }

        return Database::$DB->pdo
            ->prepare("INSERT INTO books (title, author, release_year, genre_id) 
                       VALUES ('$this->title', '$this->author', '$this->release_year', $genre_id)")
            ->execute();
    }

    public function getBookById(int $id)
    {
        $book = Database::$DB->pdo
            ->query("SELECT b.*, g.name AS genre
                     FROM books b
                     INNER JOIN genres g ON b.genre_id = g.id
                     WHERE b.id=$id")
            ->fetchAll(\PDO::FETCH_ASSOC)[0] ?? false;

        if (!$book) return null;

        $this->title        = $book['title'];
        $this->author       = $book['author'];
        $this->release_year = $book['release_year'];
        $this->genre        = $book['genre'];
        $this->id           = $book['id'];

        return true;
    }

    public function updateBook($id)
    {
        $genreModel = new GenreModel();
        $genre_id = $genreModel->getGenreIdByName($this->genre)['id'] ?? false;
        if (!$genre_id) {
            $genreModel->name = $this->genre;
            $genreModel->createGenre();
            $genre_id = $genreModel->getGenreIdByName($this->genre)['id'];
        }

        return Database::$DB->pdo
            ->prepare("UPDATE books
                       SET title        = '$this->title',
                           author       = '$this->author',
                           release_year = '$this->release_year',
                           genre_id     = $genre_id
                       WHERE id = $id;")
            ->execute();
    }

    public function deleteBook($id)
    {
        return Database::$DB->pdo
            ->prepare("DELETE FROM books
                       WHERE id = $id")
            ->execute();
    }

}
