<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\UserHashedPassword;

final class UserHashedPasswordStub
{
    public static function fromValue(string $value): UserHashedPassword
    {
        return UserHashedPassword::fromString($value);
    }

    public static function byDefault(): UserHashedPassword
    {
        return UserHashedPassword::fromString('$2y$12$wevE1Gk3RE.on6zKVZb88OCs8xTUHFteSCWCzYDXwOHjT1ZE7ZXNS');
    }
}