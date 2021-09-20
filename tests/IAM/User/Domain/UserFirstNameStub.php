<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\UserFirstName;

final class UserFirstNameStub
{
    public static function fromValue(string $value): UserFirstName
    {
        return UserFirstName::fromString($value);
    }

    public static function byDefault(): UserFirstName
    {
        return UserFirstName::fromString('Craft');
    }
}