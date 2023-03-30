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

    public string $id = '';

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
        return Database::$DB->pdo->query('SELECT * FROM visitors')->fetchAll(\PDO::FETCH_ASSOC);
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

    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function getVisitorById(int $id)
    {
        $visitor = Database::$DB->pdo->query("SELECT * FROM visitors WHERE id=$id")->fetchAll(\PDO::FETCH_ASSOC)[0] ?? false;
        if (!$visitor) return null;
        $this->firstName = $visitor['firstname'];
        $this->lastName  = $visitor['lastname'];
        $this->email     = $visitor['email'];
        $this->phone     = $visitor['phone'];
        $this->id        = $visitor['id'];
        return true;
    }

    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function updateVisitor($id)
    {
        return Database::$DB->pdo
            ->prepare("UPDATE visitors
                       SET firstname = '$this->firstName',
                           lastname  = '$this->lastName',
                           email     = '$this->email',
                           phone     = '$this->phone'
                       WHERE id = $id;")
            ->execute();
    }

    public function deleteVisitor($id)
    {
        return Database::$DB->pdo
            ->prepare("DELETE FROM visitors
                       WHERE id = $id")
            ->execute();
    }

}
