<?php


namespace App\Tests\IAM\User\Application\Query\FindByCriteria;


use App\IAM\User\Application\Query\FindByCriteria\FindUsersByCriteriaQuery;
use App\Shared\Infrastructure\Bus\Query\Criteria\JsonApiCriteriaValueFactory;
use App\Shared\Domain\Bus\Query\QueryInterface;

final class FindUsersByCriteriaQueryStub
{
    public static function byDefault(): QueryInterface
    {
        $factory = new JsonApiCriteriaValueFactory(['filter' => ['user.id' => '1']]);
        return new FindUsersByCriteriaQuery($factory);
    }
}