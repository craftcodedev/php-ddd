<?php


namespace App\Shared\Infrastructure\Bus\Query;


use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\Shared\Domain\Bus\Query\QueryInterface;
use App\Shared\Domain\Bus\Query\Response\ResponseInterface;
use App\Shared\Infrastructure\Bus\Query\Middleware\QueryHandlerMiddleware;
use App\Shared\Infrastructure\Security\Authorization\AuthorizationRepository;

final class QueryBus implements QueryBusInterface
{
    public function __construct(
        private AuthorizationRepository $authorizationRepository,
        private QueryHandlerRepository $queryHandlerRepository
    ) {
    }

    public function ask(QueryInterface $query): ResponseInterface {
        $queryClass = get_class($query);
        $authorization = $this->authorizationRepository->findByQuery($queryClass);
        $queryHandler = $this->queryHandlerRepository->findByQuery($queryClass);
        $queryHandlerMiddleware = new QueryHandlerMiddleware($authorization, $queryHandler);

        return $queryHandlerMiddleware->handle($query);
    }
}