<?php

namespace src\models;

use core\Model;

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
}

?>