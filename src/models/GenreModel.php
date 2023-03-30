<?php

namespace src\models;

use core\Model;
use core\Database;

class GenreModel extends Model
{
    public string $name = '';
    public string $id   = '';

    public function validationRules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
        ];
    }

    public function getAllGenres()
    {
        return Database::$DB->pdo->query('SELECT * FROM genres')->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createGenre()
    {
        return Database::$DB->pdo
            ->prepare("INSERT INTO genres (name) 
                       VALUES ('$this->name')")
            ->execute();
    }

    public function getGenreById(int $id)
    {
        $genre = Database::$DB->pdo->query("SELECT * FROM genres WHERE id=$id")->fetchAll(\PDO::FETCH_ASSOC)[0] ?? false;
        if (!$genre) return null;
        $this->name = $genre['name'];
        $this->id   = $genre['id'];
        return true;
    }

    public function updateGenre($id)
    {
        return Database::$DB->pdo
            ->prepare("UPDATE genres
                       SET name = '$this->name'
                       WHERE id = $id;")
            ->execute();
    }

    public function deleteGenre($id)
    {
        return Database::$DB->pdo
            ->prepare("DELETE FROM genres
                       WHERE id = $id")
            ->execute();
    }

}

?>