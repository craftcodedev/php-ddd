<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\UserPassword;

final class UserPasswordStub
{
    public static function fromValue(string $value): UserPassword
    {
        return UserPassword::fromString($value);
    }

    public static function byDefault(): UserPassword
    {
        return UserPassword::fromString('UserHashedPassword');
    }
}