<?php


namespace App\IAM\User\Infrastructure\Persistence\Doctrine;

use App\IAM\User\Domain\User;
use App\IAM\User\Domain\UserRepositoryInterface;
use App\Shared\Domain\Identifier;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

final class MySqlUserRepository extends DoctrineRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function get(Identifier $userId): ?User
    {
        return parent::get($userId);
    }
}