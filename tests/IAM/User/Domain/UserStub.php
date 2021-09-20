<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\User;

final class UserStub
{
    public static function fromValues(
        string $id = null,
        string $email = null,
        string $password = null,
        string $firstName = null,
        string $lastName = null,
        string $phone = null,
        string $roles = null
    ): User {
        return User::SignUp(
            empty($id) ? UserIdStub::byDefault() : UserIdStub::fromValue($id),
            empty($email) ? UserEmailStub::byDefault() : UserEmailStub::fromValue($email),
            empty($password) ? UserHashedPasswordStub::byDefault() : UserHashedPasswordStub::fromValue($password),
            empty($firstName) ? UserFirstNameStub::byDefault() : UserFirstNameStub::fromValue($firstName),
            empty($lastName) ? UserLastNameStub::byDefault() : UserLastNameStub::fromValue($lastName),
            empty($phone) ? UserPhoneStub::byDefault() : UserPhoneStub::fromValue($phone),
            empty($roles) ? UserRolesStub::byDefault() : UserRolesStub::fromValue($roles)
        );
    }

    public static function byDefault(): User
    {
        return User::SignUp(
            UserIdStub::byDefault(),
            UserEmailStub::byDefault(),
            UserHashedPasswordStub::byDefault(),
            UserFirstNameStub::byDefault(),
            UserLastNameStub::byDefault(),
            UserPhoneStub::byDefault(),
            UserRolesStub::byDefault()
        );
    }
}