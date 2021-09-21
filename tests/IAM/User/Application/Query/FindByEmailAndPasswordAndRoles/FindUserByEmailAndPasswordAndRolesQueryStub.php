<?php


namespace App\Tests\IAM\User\Application\Query\FindByEmailAndPasswordAndRoles;


use App\IAM\User\Application\Query\FindByEmailAndPasswordAndRoles\FindUserByEmailAndPasswordAndRolesQuery;
use App\Shared\Domain\Bus\Query\QueryInterface;
use App\Tests\IAM\User\Domain\UserPasswordStub;
use App\Tests\IAM\User\Domain\UserStub;

final class FindUserByEmailAndPasswordAndRolesQueryStub
{
    public static function byDefault(): QueryInterface
    {
        $user = UserStub::byDefault();
        $password = UserPasswordStub::byDefault();

        return new FindUserByEmailAndPasswordAndRolesQuery(
            $user->email()->value(),
            $password->value(),
            $user->roles()->value(),
        );
    }
}