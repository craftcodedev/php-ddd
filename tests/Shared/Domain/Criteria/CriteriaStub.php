<?php


namespace App\Tests\Shared\Domain\Criteria;


use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\CriteriaBuilder;

final class CriteriaStub
{
    public static function byDefault(): Criteria
    {
        return CriteriaBuilder::create()
            ->where('user.id', '2616e72d-45b9-4905-bf52-4196db49d713')
            ->build();
    }
}