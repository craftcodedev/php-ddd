<?php


namespace App\Tests\IAM\User\Application\Command\SignUp;


use App\IAM\User\Application\Command\SignUp\SignUpUserCommand;
use App\Shared\Domain\Bus\Command\CommandInterface;
use App\Tests\IAM\User\Domain\UserPasswordStub;
use App\Tests\IAM\User\Domain\UserStub;

final class SignUpUserCommandStub
{
    public static function byDefault(): CommandInterface
    {
        $user = UserStub::byDefault();
        $password = UserPasswordStub::byDefault();

        return new SignUpUserCommand(
            $user->id()->value(),
            $user->email()->value(),
            $password->value(),
            $user->firstName()->value(),
            $user->lastName()->value(),
            $user->phone()->value(),
            $user->roles()->value(),
        );
    }
}