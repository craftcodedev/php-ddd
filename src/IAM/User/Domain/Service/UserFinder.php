<?php


namespace App\IAM\User\Domain\Service;

use App\IAM\User\Domain\Service\Exception\UserNotFoundException;
use App\IAM\User\Domain\User;
use App\IAM\User\Domain\UserId;
use App\IAM\User\Domain\UserPassword;
use App\IAM\User\Domain\UserRepositoryInterface;
use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Exception\InvalidAttributeException;

final class UserFinder
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function findById(UserId $id): User
    {
        $user = $this->userRepository->get($id);

        if (null === $user) {
            throw UserNotFoundException::fromId($id->value());
        }

        return $user;
    }

    public function findByCriteriaAndPassword(Criteria $criteria, UserPassword $password): User
    {
        $users = $this->userRepository->findByCriteria($criteria);

        if (count($users) === 0) {
            throw UserNotFoundException::default();
        }

        $user = $users[0];

        if (!$user->passwordAreEquals($password)) {
            throw UserNotFoundException::fromPassword();
        }

        return $user;
    }
}