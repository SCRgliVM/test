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

    protected function getSelectByIdQuery(int $id) : string
    {
        return "SELECT * FROM genres WHERE id=$id";
    }

    protected function getUpdateStatement(int $id) : string
    {
        return "UPDATE genres
                SET name = '$this->name'
                WHERE id = $id;";
    }

    protected function getColumnToFieldMap() : array
    {
        return [
            'name' => 'name',
            'id'   => 'id',
        ];
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
