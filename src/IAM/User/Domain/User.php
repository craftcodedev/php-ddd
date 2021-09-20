<?php


namespace App\IAM\User\Domain;


use App\IAM\User\Domain\Event\UserSignedUpDomainEvent;
use App\Shared\Domain\AggregateRoot;

final class User extends AggregateRoot
{
    private function __construct(
        private UserId $id,
        private UserEmail $email,
        private UserHashedPassword $password,
        private UserFirstName $firstName,
        private UserLastName $lastName,
        private UserPhone $phone,
        private UserRoles $roles,
        private UserStatus $status,
        private UserCreatedAt $createdAt,
        private UserUpdatedAt $updatedAt
    ) {
    }

    public static function SignUp(
        UserId $id,
        UserEmail $email,
        UserHashedPassword $password,
        UserFirstName $firstName,
        UserLastName $lastName,
        UserPhone $phone,
        UserRoles $roles
    ): self
    {
        $user = new self(
            $id,
            $email,
            $password,
            $firstName,
            $lastName,
            $phone,
            $roles,
            UserStatus::byDefault(),
            UserCreatedAt::byDefault(),
            UserUpdatedAt::byDefault()
        );

        $user->record(UserSignedUpDomainEvent::create(
            $user->id()->value(),
            [
                'email' => $user->email()->value(),
                'first_name'  => $user->firstName()->value(),
                'last_name'  => $user->lastName()->value(),
                'phone'  => $user->phone()->value(),
                'roles'  => $user->roles()->value(),
                'status'  => $user->status()->value(),
                'created_at' => $user->createdAt()->toString(),
                'updated_at' => $user->updatedAt()->toString()
            ]
        ));

        return $user;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function firstName(): UserFirstName
    {
        return $this->firstName;
    }

    public function lastName(): UserLastName
    {
        return $this->lastName;
    }

    public function phone(): UserPhone
    {
        return $this->phone;
    }

    public function roles(): UserRoles
    {
        return $this->roles;
    }

    public function status(): UserStatus
    {
        return $this->status;
    }

    public function createdAt(): UserCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): UserUpdatedAt
    {
        return $this->updatedAt;
    }

    public function passwordAreEquals(UserPassword $password): bool
    {
        if (password_verify($password->value(), $this->password->value())) {
            return true;
        }

        return false;
    }
}