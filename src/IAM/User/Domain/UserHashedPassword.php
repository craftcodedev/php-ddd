<?php


namespace App\IAM\User\Domain;


use App\Shared\Domain\StringValueObject;

final class UserHashedPassword extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->value = $value;
    }
}