<?php


namespace App\IAM\User\Application\Query\FindByEmailAndPasswordAndRoles;


use App\IAM\User\Application\Query\Response\UserResponseConverter;
use App\IAM\User\Domain\Service\UserFinder;
use App\IAM\User\Domain\UserPassword;
use App\Shared\Domain\Bus\Query\Response\ResponseInterface;
use App\Shared\Domain\Criteria\Criteria;

final class FindUserByCriteriaAndPasswordUseCase
{
    public function __construct(
        private UserFinder $finder,
        private UserResponseConverter $responseConverter
    ) {
    }

    public function __invoke(Criteria $criteria, UserPassword $password): ResponseInterface
    {
        $user = $this->finder->findByCriteriaAndPassword($criteria, $password);

        return $this->responseConverter->convert($user);
    }
}