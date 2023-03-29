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

    /**
     * Get all visitors
     * @return array 
     */
    public function getAllVisitors()
    {
        $visitors = [];
        foreach (Database::$DB->pdo->query('SELECT * FROM visitors') as $row) {
            $visitors[] = $row;
        }
        return $visitors;
    }

    /**
     * Create a new visitor
     * @return [type]
     */
    public function createVisitor()
    {
        return Database::$DB->pdo
            ->prepare("INSERT INTO visitors (firstname, lastname, email, phone) 
                   VALUES ('$this->firstName', '$this->lastName', '$this->email', '$this->phone')")
            ->execute();
    }
}
