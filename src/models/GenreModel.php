<?php

namespace src\models;

use core\default\CRUDModel;
use core\Database;

class GenreModel extends CRUDModel
{
    public string $name = '';
    public string $id   = '';

    public function validationRules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
        ];
    }

    protected function getSelectAllQuery(): string
    {
        return 'SELECT * FROM genres';
    }

    protected function getCreateStatement(): string
    {
        return "INSERT INTO genres (name) 
                VALUES ('$this->name')";
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

    public function getGenreIdByName($name)
    {
        return Database::$DB->pdo
            ->query("SELECT id FROM genres WHERE name='$name'")
            ->fetch(\PDO::FETCH_ASSOC);
    }

}
