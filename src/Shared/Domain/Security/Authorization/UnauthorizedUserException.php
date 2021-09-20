<?php

namespace App\Shared\Domain\Security\Authorization;

use App\Shared\Domain\Exception\WarningException;

final class UnauthorizedUserException extends WarningException
{
    public static function fromId(string $id): self
    {
        return new static('unauthorized user with id %id%.', ['%id%' => $id]);
    }
}
