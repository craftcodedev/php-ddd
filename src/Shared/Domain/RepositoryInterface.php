<?php

namespace App\Shared\Domain;

use App\Shared\Domain\Criteria\Criteria;

interface RepositoryInterface
{
    public function add(AggregateRoot $user): void;

    public function get(Identifier $identifier): ?object;

    public function findByCriteria(Criteria $criteria): array;

    public function remove(AggregateRoot $user): void;
}
