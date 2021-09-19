<?php


namespace App\Shared\Domain;


use App\Shared\Domain\Exception\InvalidAttributeException;

class Email extends StringValueObject
{
    public const MAX_LENGTH = 60;

    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw InvalidAttributeException::fromValue('email', $value);
        }

        if (strlen($value) > self::MAX_LENGTH) {
            throw InvalidAttributeException::fromMaxLength('email', self::MAX_LENGTH);
        }

        $this->value = $value;
    }
}