<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\UserId;

final class UserIdStub
{
    public static function fromValue(string $value): UserId
    {
        return UserId::fromString($value);
    }

    public static function byDefault(): UserId
    {
        return UserId::fromString('2616e72d-45b9-4905-bf52-4196db49d713');
    }
}