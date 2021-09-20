<?php

namespace App\Shared\Domain\Criteria;

use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\StringValueObject;

final class FilterConjunction extends StringValueObject
{
    public const CONJUNCTION_AND = 'and';
    public const CONJUNCTION_OR = 'or';

    private const values = [
        FilterConjunction::CONJUNCTION_AND,
        FilterConjunction::CONJUNCTION_OR,
    ];

    public function __construct(string $value)
    {
        if (!in_array($value, FilterConjunction::values)) {
            throw InvalidAttributeException::fromValue('Filter conjunction', $value);
        }

        $this->value = $value;
    }

    public static function byDefault(): FilterConjunction
    {
        return new FilterConjunction(FilterConjunction::CONJUNCTION_AND);
    }
}
