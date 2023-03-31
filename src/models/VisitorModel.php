<?php

namespace src\models;

use core\Model;
use core\default\CRUDModel;
use core\Database;

class VisitorModel extends CRUDModel
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $phone = '';

    public string $id = '';

    protected function getSelectAllQuery(): string 
    {
        return 'SELECT * FROM visitors';
    }

    protected function getCreateStatement(): string
    {
        return "INSERT INTO visitors (firstname, lastname, email, phone) 
                VALUES ('$this->firstName', '$this->lastName', '$this->email', '$this->phone')";
    }

    protected function getSelectByIdQuery(int $id) : string
    {
        return "SELECT * FROM visitors WHERE id=$id";
    }

    protected function getColumnToFieldMap() : array
    {
        return [
            'firstname' => 'firstName',
            'lastname'  => 'lastName',
            'email'     => 'email',
            'phone'     => 'phone',
            'id'        => 'id',
        ];
    }

    protected function getUpdateStatement(int $id) : string
    {
        return "UPDATE visitors
                SET firstname = '$this->firstName',
                    lastname  = '$this->lastName',
                    email     = '$this->email',
                    phone     = '$this->phone'
                WHERE id = $id;";
    }

    /**
     * Validation rules for visitor model
     * @return array Validation rules
     */
    public function validationRules()
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName'  => [self::RULE_REQUIRED],
            'email'     => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'phone'     => [self::RULE_REQUIRED, self::RULE_PHONE],
        ];
    }

    public function deleteVisitor($id)
    {
        return Database::$DB->pdo
            ->prepare("DELETE FROM visitors
                       WHERE id = $id")
            ->execute();
    }
}
