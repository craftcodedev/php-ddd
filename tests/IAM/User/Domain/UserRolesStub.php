<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\UserRoles;
use App\Shared\Domain\Security\Authentication\AuthUser;

final class UserRolesStub
{
    public static function fromValue(string $value): UserRoles
    {
        return UserRoles::fromString($value);
    }

    public static function byDefault(): UserRoles
    {
        return UserRoles::fromString(AuthUser::ROLE_STUDENT);
    }
}