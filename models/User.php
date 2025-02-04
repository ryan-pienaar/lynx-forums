<?php

/**
 * Class User
 *
 * @package app\models
 * @author Ryan Pienaar <ryan@ryanpienaar.dev>
 */

namespace app\models;

use ryanp\paprikacore\UserModel;

class User extends UserModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_EMAIL_UNVERIFIED = 2;
    CONST STATUS_FULLY_REGISTERED = 3;
    const STATUS_BANNED = 4;

    public string $username = '';
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_EMAIL_UNVERIFIED;
    public string $password = '';
    public string $confirmPassword = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function primaryKey(): string
    {
        return 'id';
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
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'username' => [self::RULE_REQUIRED,[self::RULE_MINLEN, 'minlen' => 6], [self::RULE_MAXLEN, 'maxlen' => 16], [self::RULE_UNIQUE, 'class' => self::class]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MINLEN, 'minlen' => 8], [self::RULE_MAXLEN, 'maxlen' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes() : array
    {
        return ['username', 'firstname', 'lastname', 'email', 'password', 'status'];
    }

    public function labels(): array
    {
        return [
            'username' => 'Username',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password'
        ];
    }

    public function getDisplayName(): string
    {
        return $this->username;
    }
}