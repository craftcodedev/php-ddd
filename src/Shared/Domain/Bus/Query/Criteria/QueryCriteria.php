<?php


namespace App\Shared\Domain\Bus\Query\Criteria;


use App\Shared\Domain\Bus\Query\QueryInterface;
use App\Shared\Domain\Criteria\Criteria;

abstract class QueryCriteria implements QueryInterface
{
    public function __construct(private CriteriaValueFactoryInterface $criteriaValueFactory)
    {
    }

    public function Criteria(): Criteria
    {
        return Criteria::fromValues(
            $this->criteriaValueFactory->createFilters(),
            $this->criteriaValueFactory->createOrder(),
            $this->criteriaValueFactory->createLimit(),
            $this->criteriaValueFactory->createOffset(),
        );
    }
}