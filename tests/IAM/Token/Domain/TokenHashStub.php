<?php


namespace App\Tests\IAM\Token\Domain;


use App\IAM\Token\Domain\TokenHash;

final class TokenHashStub
{
    public static function fromValue(string $value): TokenHash
    {
        return TokenHash::fromString($value);
    }

    public static function byDefault(): TokenHash
    {
        return TokenHash::fromString('TokenHash');
    }
}