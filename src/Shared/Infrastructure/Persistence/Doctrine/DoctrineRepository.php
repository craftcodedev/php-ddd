<?php


namespace App\Shared\Infrastructure\Persistence\Doctrine;


use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Identifier;
use App\Shared\Domain\RepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

abstract class DoctrineRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function add(AggregateRoot $aggregateRoot): void
    {
        $this->getEntityManager()->persist($aggregateRoot);
    }

    public function get(Identifier $identifier): ?object
    {
        return $this->findOneBy(['id.value' => $identifier->value()]);
    }

    public function findByCriteria(Criteria $criteria): array
    {
        return $this->matching(DoctrineCriteriaConverter::convert($criteria))->toArray();
    }

    public function remove(AggregateRoot $aggregateRoot): void
    {
        $this->getEntityManager()->remove($aggregateRoot);
    }
}