<?php


namespace App\Tests\Shared\Domain;


use App\Shared\Domain\Email;

final class EmailStub
{
    public static function fromValue(string $value): Email
    {
        return Email::fromString($value);
    }

    public static function byDefault(): Email
    {
        return Email::fromString('hello@craft-code.com');
    }
}