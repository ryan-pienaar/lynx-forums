<?php

namespace app\models;

use app\core\DBModel;

class User extends DBModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_EMAIL_UNVERIFIED = 2;
    CONST STATUS_FULLY_REGISTERED = 3;
    const STATUS_BANNED = 4;

    public string $username = '';
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public int $status = self::STATUS_EMAIL_UNVERIFIED;
    public string $password = '';
    public string $confirmPassword = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function save()
    {
        $this->status = self::STATUS_EMAIL_UNVERIFIED;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'username' => [self::RULE_REQUIRED,[self::RULE_MINLEN, 'minlen' => 6], [self::RULE_MAXLEN, 'maxlen' => 16], [self::RULE_UNIQUE, 'class' => self::class]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MINLEN, 'minlen' => 8], [self::RULE_MAXLEN, 'maxlen' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes() : array
    {
        return ['username', 'firstName', 'lastName', 'email', 'password', 'status'];
    }
}