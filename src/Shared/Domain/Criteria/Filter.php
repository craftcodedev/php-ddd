<?php


namespace App\Shared\Domain\Criteria;


final class Filter
{
    private function __construct(
        private FilterEntity $entity,
        private FilterField $field,
        private FilterOperator $operator,
        private FilterValue $value,
        private FilterConjunction $conjunction
    ) {
    }

    public static function fromPrimitives(
        string $entity,
        string $field,
        string $value,
        string $operator = null,
        string $conjunction = null
    ): Filter {
        return new Filter(
            FilterEntity::fromString($entity),
            FilterField::fromString($field),
            (empty($operator)) ? FilterOperator::byDefault() : FilterOperator::fromString($operator),
            FilterValue::fromString($value),
            (empty($conjunction)) ? FilterConjunction::byDefault() : FilterConjunction::fromString($conjunction),
        );
    }

    public function entity(): FilterEntity
    {
        return $this->entity;
    }

    public function field(): FilterField
    {
        return $this->field;
    }

    public function operator(): FilterOperator
    {
        return $this->operator;
    }

    public function value(): FilterValue
    {
        return $this->value;
    }

    public function conjunction(): FilterConjunction
    {
        return $this->conjunction;
    }
}