<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\UserEmail;

final class UserEmailStub
{
    public static function fromValue(string $value): UserEmail
    {
        return UserEmail::fromString($value);
    }

    public static function byDefault(): UserEmail
    {
        return UserEmail::fromString('hello@craft-code.com');
    }
}