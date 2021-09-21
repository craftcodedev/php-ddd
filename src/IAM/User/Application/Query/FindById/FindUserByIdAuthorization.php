<?php


namespace App\IAM\User\Application\Query\FindById;


use App\Shared\Domain\Security\Authentication\AuthUserRepositoryInterface;
use App\Shared\Domain\Security\Authorization\AuthorizationInterface;
use App\Shared\Domain\Security\Authorization\UnauthorizedUserException;

final class FindUserByIdAuthorization implements AuthorizationInterface
{
    public function __construct(private AuthUserRepositoryInterface $authUserRepository)
    {

    }

    public function authorize(FindUserByIdQuery $query): void
    {
        $authUser = $this->authUserRepository->get();

        if ($query->id() != $authUser->id() && !$authUser->isAdmin()) {
            throw UnauthorizedUserException::fromId($query->id());
        }
    }
}