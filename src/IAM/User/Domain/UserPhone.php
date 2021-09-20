<?php


namespace App\IAM\User\Domain;


use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\StringValueObject;

final class UserPhone extends StringValueObject
{
    public const MAX_LENGTH = 30;

    public function __construct(string $value)
    {
        if (strlen($value) > self::MAX_LENGTH) {
            throw InvalidAttributeException::fromMaxLength('phone', self::MAX_LENGTH);
        }

        $this->value = $value;
    }
}