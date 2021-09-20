<?php


namespace App\IAM\User\Application\Query\FindByEmailAndPasswordAndRoles;


use App\IAM\User\Domain\UserPassword;
use App\Shared\Domain\Bus\Query\QueryHandlerInterface;
use App\Shared\Domain\Bus\Query\Response\ResponseInterface;
use App\Shared\Domain\Criteria\CriteriaBuilder;
use App\Shared\Domain\Criteria\FilterOperator;

final class FindUserByEmailAndPasswordAndRolesQueryHandler implements QueryHandlerInterface
{
    public function __construct(private FindUserByCriteriaAndPasswordUseCase $findUserByCriteriaAndPasswordUseCase)
    {

    }

    public function handle(FindUserByEmailAndPasswordAndRolesQuery $query): ResponseInterface
    {
        $criteria = CriteriaBuilder::create()
            ->where('user.email', $query->email())
            ->andWhere('user.roles', $query->roles(), FilterOperator::OPERATOR_CONTAINS)
            ->build();

        $password = UserPassword::fromString($query->password());

        return $this->findUserByCriteriaAndPasswordUseCase->__invoke($criteria, $password);
    }
}