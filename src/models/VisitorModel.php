<?php

namespace src\models;

use core\Model;
use core\Database;

class VisitorModel extends Model
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $phone = '';

    public function validationRules()
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName'  => [self::RULE_REQUIRED],
            'email'     => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'phone'     => [self::RULE_REQUIRED, self::RULE_PHONE],
        ];
    }

    public function getAllVisitors()
    {
        $visitors = [];
        foreach (Database::$DB->pdo->query('SELECT * FROM visitors') as $row) {
            $visitors[] = $row;
        }
        return $visitors;
    }

    public function createUser()
    {
        return Database::$DB->pdo
            ->prepare("INSERT INTO visitors (firstname, lastname, email, phone) 
                   VALUES ('$this->firstName', '$this->lastName', '$this->email', '$this->phone')")
            ->execute();
    }
}
