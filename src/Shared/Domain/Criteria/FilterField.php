<?php


namespace App\Shared\Domain\Criteria;


use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\StringValueObject;

final class FilterField extends StringValueObject
{
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw InvalidAttributeException::fromEmpty('Filter field');
        }

        $this->value = $value;
    }
}