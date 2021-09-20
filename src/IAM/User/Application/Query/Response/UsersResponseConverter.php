<?php


namespace App\IAM\User\Application\Query\Response;


use App\Shared\Domain\Bus\Query\Response\AggregateRootsResponseConverter;

final class UsersResponseConverter extends AggregateRootsResponseConverter
{
    public function __construct()
    {
        parent::__construct(new UserResponseConverter());
    }
}