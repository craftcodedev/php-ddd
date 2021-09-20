<?php


namespace App\Tests\Shared\Domain\Security\Authentication;


use App\Shared\Domain\Security\Authentication\AuthUser;

final class AuthUserStub
{
    public static function fromValues(
        string $id = null,
        string $email = null,
        string $firstName = null,
        string $lastName = null,
        array $roles = []
    ): AuthUser {
        return AuthUser::fromValues(
            empty($id) ? '2616e72d-45b9-4905-bf52-4196db49d713' : $id,
            empty($email) ? 'hello@craft-code.com' : $email,
            empty($firstName) ? 'Craft' : $firstName,
            empty($lastName) ? 'Code' : $lastName,
            count($roles) === 0 ? [AuthUser::ROLE_STUDENT] : $roles
        );
    }

    public static function byDefault(): AuthUser
    {
        return AuthUser::fromValues(
            '2616e72d-45b9-4905-bf52-4196db49d713',
            'hello@craft-code.com',
            'Craft',
            'Code',
            [AuthUser::ROLE_STUDENT]
        );
    }
}