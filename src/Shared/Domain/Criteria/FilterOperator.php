<?php

namespace App\Shared\Domain\Criteria;

use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\StringValueObject;

final class FilterOperator extends StringValueObject
{
    public const OPERATOR_EQ = 'eq';
    public const OPERATOR_NEQ = 'neq';
    public const OPERATOR_LT = 'lt';
    public const OPERATOR_LTE = 'lte';
    public const OPERATOR_GT = 'gt';
    public const OPERATOR_GTE = 'gte';
    public const OPERATOR_IN = 'in';
    public const OPERATOR_CONTAINS = 'contains';

    private const values = [
        FilterOperator::OPERATOR_EQ,
        FilterOperator::OPERATOR_NEQ,
        FilterOperator::OPERATOR_LT,
        FilterOperator::OPERATOR_LTE,
        FilterOperator::OPERATOR_GT,
        FilterOperator::OPERATOR_GTE,
        FilterOperator::OPERATOR_IN,
        FilterOperator::OPERATOR_CONTAINS,
    ];

    public function __construct(string $value)
    {
        if (!in_array($value, FilterOperator::values)) {
            throw InvalidAttributeException::fromValue('Filter operator', $value);
        }

        $this->value = $value;
    }

    public static function byDefault(): FilterOperator
    {
        return new FilterOperator(FilterOperator::OPERATOR_EQ);
    }
}
