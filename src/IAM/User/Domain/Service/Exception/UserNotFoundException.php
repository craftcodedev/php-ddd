<?php


namespace App\IAM\User\Domain\Service\Exception;

use App\Shared\Domain\Exception\ResourceNotFoundException;

final class UserNotFoundException extends ResourceNotFoundException
{
    public static function default(): self
    {
        return new self('user not found.');
    }

    public static function fromId(string $id): self
    {
        return new self('user with id "%id%" not found.', ["%id%" => $id]);
    }

    public static function fromPassword(): self
    {
        return new self('wrong password.');
    }
}