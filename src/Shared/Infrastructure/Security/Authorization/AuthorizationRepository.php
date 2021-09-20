<?php

namespace App\Shared\Infrastructure\Security\Authorization;

use App\Shared\Domain\Helper\Reflection;
use App\Shared\Domain\Security\Authorization\AuthorizationInterface;

final class AuthorizationRepository
{
    private array $authorizations;

    public function __construct(iterable $authorizations)
    {
        $this->setAuthorizations($authorizations);
    }

    private function setAuthorizations(iterable $authorizations): void
    {
        foreach (iterator_to_array($authorizations) as $authorization) {
            $authorizationName = get_class($authorization);
            $this->authorizations[$authorizationName] = $authorization;
        }
    }

    public function findByQuery(string $query): AuthorizationInterface
    {
        $queryClassName = Reflection::className($query);
        $authorizationClassName = str_replace('Query', 'Authorization', $queryClassName);
        $authorization = str_replace($queryClassName, $authorizationClassName, $query);

        return $this->findByAuthorizationName($authorization);
    }

    public function findByCommand(string $command): AuthorizationInterface
    {
        $commandClassName = Reflection::className($command);
        $authorizationClassName = str_replace('Command', 'Authorization', $commandClassName);
        $authorization = str_replace($commandClassName, $authorizationClassName, $command);

        return $this->findByAuthorizationName($authorization);
    }

    private function findByAuthorizationName(string $name): AuthorizationInterface
    {
        if (isset($this->authorizations[$name])) {
            return $this->authorizations[$name];
        }

        return new DefaultAuthorization();
    }
}
