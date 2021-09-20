<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\UserStatus;

final class UserStatusStub
{
    public static function fromValue(string $value): UserStatus
    {
        return UserStatus::fromString($value);
    }

    public static function byDefault(): UserStatus
    {
        return UserStatus::byDefault();
    }
}