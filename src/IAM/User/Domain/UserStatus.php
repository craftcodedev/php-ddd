<?php


namespace App\IAM\User\Domain;

use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\StringValueObject;

final class UserStatus extends StringValueObject
{
    const STATUS_ACTIVE = 'active';
    const STATUS_SUSPENDED = 'suspended';
    const STATUS_CANCELED = 'canceled';

    public function __construct(string $value)
    {
        if ($value !== self::STATUS_ACTIVE && $value !== self::STATUS_SUSPENDED && $value !== self::STATUS_CANCELED) {
            throw InvalidAttributeException::fromValue('status', $value);
        }

        $this->value = $value;
    }

    public static function byDefault(): UserStatus
    {
        return new self(UserStatus::STATUS_ACTIVE);
    }
}