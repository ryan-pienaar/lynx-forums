<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MINLEN = 'minlen';
    public const RULE_MAXLEN = 'maxlen';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public array $errors = [];

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MINLEN && strlen($value) < $rule['minlen']) {
                    $this->addError($attribute, self::RULE_MINLEN, $rule);
                }
                if ($ruleName === self::RULE_MAXLEN && strlen($value) > $rule['maxlen']) {
                    $this->addError($attribute, self::RULE_MAXLEN, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttribute = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Kernel::$kernel->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttribute = :attribute");
                    $statement->bindValue(":attribute", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();

                    if ($record) {
                        $this->addError($attribute, self::RULE_UNIQUE, ['field' => $attribute]);
                    }

                }
            }
        }
        if (!$this->containsErrors($this->errors)) {
            return true;
        }
        return false;
    }

    public function addError(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email address',
            self::RULE_MINLEN => 'Min length of this field must be {min}',
            self::RULE_MAXLEN => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'An account with this {field} already exists'
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }

    public function containsErrors(array $errors): bool
    {
        return count($errors) > 0;
    }
}