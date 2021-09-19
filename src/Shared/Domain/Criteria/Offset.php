<?php


namespace App\Shared\Domain\Criteria;


use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\IntValueObject;
use App\Shared\Domain\StringValueObject;

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