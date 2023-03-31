<?php

namespace core\default;
use core\Model;
use core\Database;

abstract class CRUDModel extends Model
{
    protected string $sqlGetAll = '';

    abstract protected function getSelectAllQuery()   : string;
    abstract protected function getCreateStatement()  : string;
    abstract protected function getSelectByIdQuery(int $id)  : string;
    abstract protected function getUpdateStatement(int $id)  : string;

    abstract protected function getColumnToFieldMap() : array;

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

    public function getById(int $id) : bool | null
    {
        $column = Database::$DB->pdo
            ->query($this->getSelectByIdQuery($id))
            ->fetchAll(\PDO::FETCH_ASSOC)[0] ?? false;

        if (!$column) return null;

        $namesMap = $this->getColumnToFieldMap();

        foreach ($column as $columnName => $columnValue) {
            $fieldName = $namesMap[$columnName] ?? false;
            if (!$fieldName) continue;
            $this->{$fieldName} = $columnValue;
        }

        return true;
    }

    public function update(int $id)
    {
        return Database::$DB->pdo
            ->prepare($this->getUpdateStatement($id))
            ->execute();
    }

}

?>