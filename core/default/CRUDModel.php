<?php

namespace core\default;
use core\Model;
use core\Database;

abstract class CRUDModel extends Model
{
    protected string $sqlGetAll = '';

    abstract protected function getSelectAllQuery() : string;

    public function getAll()
    {
        return Database::$DB->pdo
            ->query($this->getSelectAllQuery())
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    

}

?>