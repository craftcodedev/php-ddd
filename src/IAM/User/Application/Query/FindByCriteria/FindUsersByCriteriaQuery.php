<?php


namespace App\IAM\User\Application\Query\FindByCriteria;


use App\Shared\Domain\Bus\Query\Criteria\CriteriaValueFactoryInterface;
use App\Shared\Domain\Bus\Query\Criteria\QueryCriteria;

final class FindUsersByCriteriaQuery extends QueryCriteria
{
    public function __construct(CriteriaValueFactoryInterface $criteriaValueFactory)
    {
        parent::__construct($criteriaValueFactory);
    }
}