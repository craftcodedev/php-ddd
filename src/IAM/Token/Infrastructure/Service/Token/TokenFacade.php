<?php


namespace App\IAM\Token\Infrastructure\Service\Token;


use App\IAM\User\Application\Query\FindByEmailAndPasswordAndRoles\FindUserByEmailAndPasswordAndRolesQuery;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\Shared\Domain\Bus\Query\Response\ResponseInterface;

final class TokenFacade
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function findUserFromEmailAndPasswordAndRole(string $email, string $password, string $role): ResponseInterface
    {
        $user = $this->queryBus->ask(new FindUserByEmailAndPasswordAndRolesQuery($email, $password, $role));

        return $user;
    }
}