<?php

namespace core\default;
use core\Model;
use core\Database;

abstract class CRUDModel extends Model
{
    protected string $sqlGetAll = '';

    abstract protected function getSelectAllQuery()  : string;
    abstract protected function getCreateStatement() : string;

    public function getAll()
    {
        return Database::$DB->pdo
            ->query($this->getSelectAllQuery())
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create()
    {
        return Database::$DB->pdo
            ->prepare($this->getCreateStatement())
            ->execute();
    }

}

?>