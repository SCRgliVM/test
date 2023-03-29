<?php

namespace core;

class Model
{
    const RULE_REQUIRED = 'required';
    const RULE_EMAIL = 'email';
    const RULE_PHONE = 'phone';
    const RULE_UNIQUE = 'unique';
    const RULE_YEAR = 'year';
    const RULE_MAX_YEAR = '2023';

    public array $validationErrors = [];

    public function getErrorMessages()
    {
        return [
            self::RULE_REQUIRED => 'Required',
            self::RULE_EMAIL => 'Must be valid email address',
            self::RULE_PHONE => 'Must be valid phone number',
            self::RULE_UNIQUE => 'Already exists',
            self::RULE_YEAR => 'Must be valid year',
            self::RULE_MAX_YEAR => 'The year must not be greater than 2023',
        ];
    }

    public function getErrorMessage($rule)
    {
        return $this->getErrorMessages()[$rule];
    }

    protected function addError(string $field, string $rule)
    {
        $errorMessage = $this->getErrorMessage($rule);
        $this->validationErrors[$field][] = $errorMessage;
    }

    public function hasError($field)
    {
        return $this->validationErrors[$field] ?? false;
    }

    public function getFirstError($field)
    {
        $errors = $this->validationErrors[$field] ?? [];
        return $errors[0] ?? '';
    }

    public function validationRules()
    {
        return [];
    }

    public function validate()
    {
        foreach ($this->validationRules() as $field => $rules)
        {
            $fieldValue = $this->{$field};
            foreach ($rules as $rule)
            {
                if ($rule === self::RULE_REQUIRED && !$fieldValue) {
                    $this->addError($field, self::RULE_REQUIRED);
                }
                if ($rule === self::RULE_EMAIL && !filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, self::RULE_EMAIL);
                }
                if ($rule === self::RULE_PHONE && !preg_match('/^[0-9]{10}$/', $fieldValue)) {
                    $this->addError($field, self::RULE_PHONE);
                }
                if ($rule === self::RULE_YEAR && !(is_int($fieldValue) && $fieldValue > 0))  {
                    $this->addError($field, self::RULE_YEAR);
                }
                if ($rule === self::RULE_MAX_YEAR && !(is_int($fieldValue) && $fieldValue <= 2023))  {
                    $this->addError($field, self::RULE_MAX_YEAR);
                }
            }
        }
        return empty($this->validationErrors);
    }

    public function load($payload)
    {
        foreach ($payload as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

}
