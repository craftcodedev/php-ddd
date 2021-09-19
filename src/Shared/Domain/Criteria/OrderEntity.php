<?php


namespace App\Shared\Domain\Criteria;


use App\Shared\Domain\StringValueObject;

final class OrderEntity extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->value = $value;
    }
}