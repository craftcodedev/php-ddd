<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\UserLastName;

final class UserLastNameStub
{
    public static function fromValue(string $value): UserLastName
    {
        return UserLastName::fromString($value);
    }

    public static function byDefault(): UserLastName
    {
        return UserLastName::fromString('Code');
    }
}