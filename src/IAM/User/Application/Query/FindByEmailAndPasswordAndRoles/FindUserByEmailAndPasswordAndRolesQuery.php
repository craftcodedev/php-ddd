<?php


namespace App\IAM\User\Application\Query\FindByEmailAndPasswordAndRoles;


use App\Shared\Domain\Bus\Query\QueryInterface;

final class FindUserByEmailAndPasswordAndRolesQuery implements QueryInterface
{
    public function __construct(private string $email, private string $password, private string $roles)
    {
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function roles(): string
    {
        return $this->roles;
    }
}