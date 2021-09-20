<?php


namespace App\IAM\User\Domain;


use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\StringValueObject;

final class UserPassword extends StringValueObject
{
    public function __construct(string $value)
    {
        $pattern = '/^([\w\W.\d\D\s]{8,20})$/';

        if (!preg_match($pattern, $value)) {
            throw InvalidAttributeException::fromValue('password', $value);
        }

        $this->value = $value;
    }
}