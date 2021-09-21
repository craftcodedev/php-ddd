<?php


namespace App\IAM\User\Application\Query\FindByCriteria;


use App\IAM\User\Application\Query\Response\UsersResponseConverter;
use App\IAM\User\Domain\UserRepositoryInterface;
use App\Shared\Domain\Bus\Query\Response\ResponseInterface;
use App\Shared\Domain\Criteria\Criteria;

final class FindUsersByCriteriaUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UsersResponseConverter $responseConverter
    ) {
    }

    public function __invoke(Criteria $criteria): ResponseInterface
    {
        $users = $this->userRepository->findByCriteria($criteria);

        return $this->responseConverter->convert($users);
    }
}