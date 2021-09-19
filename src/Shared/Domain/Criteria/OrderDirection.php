<?php


namespace App\Shared\Domain\Criteria;


use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\StringValueObject;

final class OrderDirection extends StringValueObject
{
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw InvalidAttributeException::fromEmpty('order field');
        }

        $this->value = ($value === '-') ? 'DESC' : 'ASC';
    }

    public static function byDefault(): OrderDirection
    {
        return new OrderDirection('ASC');
    }
}