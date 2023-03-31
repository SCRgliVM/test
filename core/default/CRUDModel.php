<?php

namespace core\default;
use core\Model;
use core\Database;

abstract class CRUDModel extends Model
{
    protected string $sqlGetAll = '';

    /**
     * Model's select all query
     * @return string
     */
    abstract protected function getSelectAllQuery()   : string;
    /**
     * Model's create statement
     * @return string
     */
    abstract protected function getCreateStatement()  : string;
    /**
     * Model's select by id query
     * @param int $id
     * 
     * @return string
     */
    abstract protected function getSelectByIdQuery(int $id)  : string;
    /**
     * Model's update statement
     * @param int $id
     * 
     * @return string
     */
    abstract protected function getUpdateStatement(int $id)  : string;
    /**
     * Model's delete statement
     * @param int $id
     * 
     * @return string
     */
    abstract protected function getDeleteStatement(int $id)  : string;

    /**
     * Database column name -> Field name mapping
     * @return array
     */
    abstract protected function getColumnToFieldMap() : array;

    /**
     * Get all model's entries
     * @return [type]
     */
    public function getAll()
    {
        return Database::$DB->pdo
            ->query($this->getSelectAllQuery())
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Create model entry
     * @return [type]
     */
    public function create()
    {
        return Database::$DB->pdo
            ->prepare($this->getCreateStatement())
            ->execute();
    }

    /**
     * Get model's columns tp corresponding fields
     * @param int $id
     * 
     * @return bool
     */
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

    /**
     * Update model's entry
     * @param int $id
     * 
     * @return [type]
     */
    public function update(int $id)
    {
        return Database::$DB->pdo
            ->prepare($this->getUpdateStatement($id))
            ->execute();
    }

    /**
     * Delete model's entry
     * @param int $id
     * 
     * @return [type]
     */
    public function delete(int $id)
    {
        return Database::$DB->pdo
            ->prepare($this->getDeleteStatement($id))
            ->execute();
    }

}

?>