<?php


namespace App\IAM\User\Domain;


use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\StringValueObject;

final class UserLastName extends StringValueObject
{
    public const MIN_LENGTH = 3;
    public const MAX_LENGTH = 40;

    public function __construct(string $value)
    {
        if (strlen($value) < self::MIN_LENGTH) {
            throw InvalidAttributeException::fromMinLength('last name', self::MIN_LENGTH);
        }

        if (strlen($value) > self::MAX_LENGTH) {
            throw InvalidAttributeException::fromMaxLength('last name', self::MAX_LENGTH);
        }

        $this->value = $value;
    }
}