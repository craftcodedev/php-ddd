<?php


namespace App\IAM\Token\Domain;


use App\Shared\Domain\StringValueObject;

final class TokenHash extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->value = $value;
    }
}