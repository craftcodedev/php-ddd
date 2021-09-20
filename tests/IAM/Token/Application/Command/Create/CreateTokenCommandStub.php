<?php


namespace App\Tests\IAM\Token\Application\Command\Create;


use App\IAM\Token\Application\Command\Create\CreateTokenCommand;
use App\Shared\Domain\Bus\Command\CommandInterface;
use App\Shared\Domain\Security\Authentication\AuthUser;
use App\Tests\Shared\Domain\EmailStub;

final class CreateTokenCommandStub
{
    public static function byDefault(): CommandInterface
    {
        $email = EmailStub::byDefault()->value();
        $password = "12345678";
        $role = AuthUser::ROLE_STUDENT;

        return new CreateTokenCommand($email, $password, $role);
    }
}