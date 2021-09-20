<?php


namespace App\IAM\User\Application\Query\Response;


use App\IAM\User\Domain\User;
use App\Shared\Domain\Bus\Query\Response\ResponseConverterInterface;

final class UserResponseConverter implements ResponseConverterInterface
{
    public function convert(User $user, $resources = []): UserResponse
    {
        return new UserResponse(
            $user->id()->value(),
            $user->email()->value(),
            $user->firstName()->value(),
            $user->lastName()->value(),
            $user->phone()->value(),
            $user->roles()->value(),
            $user->status()->value(),
            $user->createdAt()->toString(),
            $user->updatedAt()->toString()
        );
    }
}