<?php


namespace App\IAM\User\Application\Query\FindById;


use App\IAM\User\Domain\UserId;
use App\Shared\Domain\Bus\Query\QueryHandlerInterface;
use App\Shared\Domain\Bus\Query\Response\ResponseInterface;

final class FindUserByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(private FindUserByIdUseCase $findUserByIdUseCase)
    {
    }

    public function handle(FindUserByIdQuery $query): ResponseInterface
    {
        $userId = UserId::fromString($query->id());

        return $this->findUserByIdUseCase->__invoke($userId);
    }
}