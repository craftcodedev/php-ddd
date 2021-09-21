<?php


namespace App\IAM\User\Application\Query\FindById;


use App\IAM\User\Application\Query\Response\UserResponseConverter;
use App\IAM\User\Domain\Service\UserFinder;
use App\IAM\User\Domain\UserId;
use App\Shared\Domain\Bus\Query\Response\ResponseInterface;

final class FindUserByIdUseCase
{
    public function __construct(
        private UserFinder $finder,
        private UserResponseConverter $responseConverter
    ) {
    }

    public function __invoke(UserId $id): ResponseInterface
    {
        $user = $this->finder->findById($id);

        return $this->responseConverter->convert($user);
    }
}