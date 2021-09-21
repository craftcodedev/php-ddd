<?php


namespace App\Tests\IAM\User\Application\Query\FindById;


use App\IAM\User\Application\Query\FindById\FindUserByIdQuery;
use App\Shared\Domain\Bus\Query\QueryInterface;
use App\Tests\IAM\User\Domain\UserStub;

final class FindUserByIdQueryStub
{
    public static function byDefault(): QueryInterface
    {
        $user = UserStub::byDefault();

        return new FindUserByIdQuery(
            $user->id()->value()
        );
    }
}