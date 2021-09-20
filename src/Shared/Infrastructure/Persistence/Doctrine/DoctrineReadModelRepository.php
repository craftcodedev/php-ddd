<?php

namespace App\Shared\Infrastructure\Persistence\Doctrine;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\ReadModel\ReadModelInterface;
use App\Shared\ReadModel\ReadModelRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

abstract class DoctrineReadModelRepository extends ServiceEntityRepository implements ReadModelRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function add(ReadModelInterface $readModel): void
    {
        $this->getEntityManager()->persist($readModel);
    }

    public function get(string $id): ?object
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findByCriteria(Criteria $criteria): array
    {
        return $this->matching(DoctrineCriteriaConverter::convert($criteria, 'ReadModel'))->toArray();
    }

    public function remove(ReadModelInterface $readModel): void
    {
        $this->getEntityManager()->remove($readModel);
    }
}
