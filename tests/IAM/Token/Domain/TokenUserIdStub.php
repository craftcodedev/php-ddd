<?php


namespace App\Tests\IAM\Token\Domain;


use App\IAM\Token\Domain\TokenUserId;

final class TokenUserIdStub
{
    public static function fromValue(string $value): TokenUserId
    {
        return TokenUserId::fromString($value);
    }

    public static function byDefault(): TokenUserId
    {
        return TokenUserId::fromString('2616e72d-45b9-4905-bf52-4196db49d713');
    }
}