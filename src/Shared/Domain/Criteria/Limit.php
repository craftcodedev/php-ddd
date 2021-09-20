<?php

namespace App\Shared\Domain\Criteria;

use App\Shared\Domain\IntValueObject;

final class Limit extends IntValueObject
{
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function byDefault(): Limit
    {
        return new Limit(10);
    }
}
