<?php


namespace App\IAM\User\Application\Command\SignUp;


use App\Shared\Domain\Bus\Command\CommandInterface;

final class SignUpUserCommand implements CommandInterface
{
    public function __construct(
        private string $id,
        private string $email,
        private string $password,
        private string $firstName,
        private string $lastName,
        private string $phone,
        private string $roles
    ) {
    }

    public function id() : string
    {
        return $this->id;
    }

    public function email() : string
    {
        return $this->email;
    }

    public function password() : string
    {
        return $this->password;
    }

    public function firstName() : string
    {
        return $this->firstName;
    }

    public function lastName() : string
    {
        return $this->lastName;
    }

    public function phone() : string
    {
        return $this->phone;
    }

    public function roles() : string
    {
        return $this->roles;
    }
}