<?php


namespace App\IAM\User\Application\Command\SignUp;


use App\IAM\User\Domain\User;
use App\IAM\User\Domain\UserEmail;
use App\IAM\User\Domain\UserFirstName;
use App\IAM\User\Domain\UserHashedPassword;
use App\IAM\User\Domain\UserId;
use App\IAM\User\Domain\UserLastName;
use App\IAM\User\Domain\UserPhone;
use App\IAM\User\Domain\UserRepositoryInterface;
use App\IAM\User\Domain\UserRoles;
use App\Shared\Domain\Bus\Event\EventProvider;

final class SignUpUserUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository, private EventProvider $eventProvider)
    {
    }

    public function __invoke(
        UserId $id,
        UserEmail $email,
        UserHashedPassword $hashedPassword,
        UserFirstName $firstName,
        UserLastName $lastName,
        UserPhone $phone,
        UserRoles $roles
    ): void {
        $user = User::SignUp($id, $email, $hashedPassword, $firstName, $lastName, $phone, $roles);

        $this->userRepository->add($user);

        $this->eventProvider->record(...$user->releaseEvents());
    }
}