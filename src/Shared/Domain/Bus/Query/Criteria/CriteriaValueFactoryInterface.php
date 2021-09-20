<?php

namespace App\Shared\Domain\Bus\Query\Criteria;

use App\Shared\Domain\Criteria\Limit;
use App\Shared\Domain\Criteria\Offset;

interface CriteriaValueFactoryInterface
{
    public function createFilters(): array;

    public function createOrder(): array;

    public function createLimit(): Limit;

    public function createOffset(): Offset;
}
