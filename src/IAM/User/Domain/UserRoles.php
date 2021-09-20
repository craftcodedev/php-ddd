<?php


namespace App\IAM\User\Domain;


use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\Security\Authentication\AuthUser;
use App\Shared\Domain\StringValueObject;

final class UserRoles extends StringValueObject
{
    public function __construct(string $value)
    {
        $roles = explode(',', $value);

        foreach ($roles as $role) {
            if (!AuthUser::contains($role)) {
                throw InvalidAttributeException::fromValue('roles', $value);
            }
        }

        $this->value = $value;
        $rolesTotal = count(explode(',', $this->value));

        if ($this->isStudent() && $rolesTotal > 1) {
            throw InvalidAttributeException::fromText('student user can have only one role');
        }
    }

    public function isStudent(): bool
    {
        return str_contains($this->value, AuthUser::ROLE_STUDENT);
    }

    public function isTeacher(): bool
    {
        return str_contains($this->value, AuthUser::ROLE_TEACHER);
    }

    public function isAdmin(): bool
    {
        return str_contains($this->value, AuthUser::ROLE_ADMIN);
    }
}