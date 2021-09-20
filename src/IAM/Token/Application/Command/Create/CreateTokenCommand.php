<?php


namespace App\IAM\Token\Application\Command\Create;


use App\Shared\Domain\Bus\Command\CommandInterface;

final class CreateTokenCommand implements CommandInterface
{

    public function __construct(private string $email, private string $password, private string $role)
    {
    }

    public function email() : string
    {
        return $this->email;
    }

    public function password() : string
    {
        return $this->password;
    }

    public function role() : string
    {
        return $this->role;
    }
}
