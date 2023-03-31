<?php

namespace core;

/**
 * Basic class for models
 */
class Model
{
    const RULE_REQUIRED = 'required';
    const RULE_EMAIL = 'email';
    const RULE_PHONE = 'phone';
    const RULE_UNIQUE = 'unique';
    const RULE_YEAR = 'year';
    const RULE_MAX_YEAR = '2023';

    /**
     * @var array Array of corresponding error messages to each model field
     */
    public array $validationErrors = [];

    /**
     * Get error messages map
     * @return array Error messages
     */
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

    /**
     * Get error message for validation rule
     * @param mixed $rule Validation rule to resolve
     * 
     * @return string Error message for given validation rule
     */
    public function getErrorMessage($rule)
    {
        return $this->getErrorMessages()[$rule];
    }

    /**
     * Add validation error to field by rule
     * @param string $field Field
     * @param string $rule Broken validation rule
     * 
     * @return void
     */
    protected function addError(string $field, string $rule)
    {
        $errorMessage = $this->getErrorMessage($rule);
        $this->validationErrors[$field][] = $errorMessage;
    }

    /**
     * Checks if there is at least one validation error for a given field
     * @param string $field
     * 
     * @return bool
     */
    public function hasError(string $field)
    {
        return $this->validationErrors[$field] ?? false;
    }

    /**
     * Get first validation error for a given field
     * @param mixed $field
     * 
     * @return string
     */
    public function getFirstError($field)
    {
        $errors = $this->validationErrors[$field] ?? [];
        return $errors[0] ?? '';
    }

    /**
     * Fallback empty validation rules if child class not define own
     * @return array
     */
    public function validationRules()
    {
        return [];
    }

    /**
     * Validate model fields and set validation errors
     * @return bool True if none of rules were violated
     */
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
                if ($rule === self::RULE_YEAR && !(is_int((int)$fieldValue) && $fieldValue > 0))  {
                    $this->addError($field, self::RULE_YEAR);
                }
                if ($rule === self::RULE_MAX_YEAR && !(is_int((int)$fieldValue) && $fieldValue <= 2023))  {
                    $this->addError($field, self::RULE_MAX_YEAR);
                }
            }
        }
        return empty($this->validationErrors);
    }

    /**
     * Load form fields values as object properties
     * @param mixed $payload
     * 
     * @return void
     */
    public function load($payload)
    {
        foreach ($payload as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

}
