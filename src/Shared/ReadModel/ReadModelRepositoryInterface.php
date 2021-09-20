<?php

namespace App\Shared\ReadModel;

use App\Shared\Domain\Criteria\Criteria;

interface ReadModelRepositoryInterface
{
    public function add(ReadModelInterface $readModel): void;

    public function get(string $id): ?object;

    public function findByCriteria(Criteria $criteria): array;

    public function remove(ReadModelInterface $readModel): void;
}
