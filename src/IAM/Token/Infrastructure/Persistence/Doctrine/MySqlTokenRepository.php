<?php


namespace App\IAM\Token\Infrastructure\Persistence\Doctrine;

use App\IAM\Token\Domain\Token;
use App\IAM\Token\Domain\TokenRepositoryInterface;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

final class MySqlTokenRepository extends DoctrineRepository implements TokenRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Token::class);
    }
}