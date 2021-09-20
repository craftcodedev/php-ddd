<?php

namespace App\Shared\Domain\Criteria;

use App\Shared\Domain\IntValueObject;

final class Offset extends IntValueObject
{
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function ByDefault(): Offset
    {
        return new Offset(0);
    }
}
