<?php


namespace App\IAM\User\Application\Query\FindByCriteria;


use App\Shared\Domain\Bus\Query\QueryHandlerInterface;
use App\Shared\Domain\Bus\Query\Response\ResponseInterface;

final class FindUsersByCriteriaQueryHandler implements QueryHandlerInterface
{
    public function __construct(private FindUsersByCriteriaUseCase $findUsersByCriteriaUseCase)
    {
    }

    public function handle(FindUsersByCriteriaQuery $query): ResponseInterface
    {
        $criteria = $query->Criteria();

        return $this->findUsersByCriteriaUseCase->__invoke($criteria);
    }
}