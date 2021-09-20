<?php


namespace App\IAM\User\Application\Command\SignUp;


use App\IAM\User\Domain\UserEmail;
use App\IAM\User\Domain\UserFirstName;
use App\IAM\User\Domain\UserHashedPassword;
use App\IAM\User\Domain\UserId;
use App\IAM\User\Domain\UserLastName;
use App\IAM\User\Domain\UserPassword;
use App\IAM\User\Domain\UserPhone;
use App\IAM\User\Domain\UserRoles;
use App\Shared\Domain\Bus\Command\CommandHandlerInterface;
use App\Shared\Infrastructure\Service\Hashing\HashingInterface;

final class SignUpUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(private HashingInterface $hashing, private SignUpUserUseCase $signUpUserUseCase)
    {

    }
    public function handle(SignUpUserCommand $command): void
    {
        $id = UserId::fromString($command->id());
        $email = UserEmail::fromString($command->email());
        $password = UserPassword::fromString($command->password());
        $hashedPassword = UserHashedPassword::fromString($this->hashing->hash($password->value())->value());
        $firstName = UserFirstName::fromString($command->firstName());
        $lastName = UserLastName::fromString($command->lastName());
        $phone = UserPhone::fromString($command->phone());
        $roles = UserRoles::fromString($command->roles());


        $this->signUpUserUseCase->__invoke($id, $email, $hashedPassword, $firstName, $lastName, $phone, $roles);
    }
}