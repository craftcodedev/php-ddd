<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\UserPhone;

final class UserPhoneStub
{
    public static function fromValue(string $value): UserPhone
    {
        return UserPhone::fromString($value);
    }

    public static function byDefault(): UserPhone
    {
        return UserPhone::fromString('1234567890123');
    }
}