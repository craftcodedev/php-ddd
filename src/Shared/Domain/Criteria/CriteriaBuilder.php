<?php

namespace App\Shared\Domain\Criteria;


final class CriteriaBuilder
{
    private function __construct(
        private array $filters,
        private array $order,
        private Limit $limit,
        private Offset $offset
    ) {
    }

    public static function create(): self
    {
        return new CriteriaBuilder([], [], Limit::byDefault(), Offset::byDefault());
    }

    public function where(string $field, string $value, string $operator = null): CriteriaBuilder
    {
        if (count($this->filters) > 0) {
            throw CriteriaBuilderException::fromWhere();
        }

        $filter = $this->createFilter($field, $operator, $value, FilterConjunction::byDefault()->value());
        $this->filters[] = $filter;

        return $this;
    }

    public function andWhere(string $field, string $value, string $operator = null): CriteriaBuilder
    {
        $filter = $this->createFilter($field, $operator, $value, FilterConjunction::byDefault()->value());
        $this->filters[] = $filter;
        return $this;
    }

    public function orWhere(string $field, string $value, string $operator = null): CriteriaBuilder
    {
        $filter = $this->createFilter($field, $operator, $value, FilterConjunction::fromString("or")->value());
        $this->filters[] = $filter;
        return $this;
    }

    public function addOrderBy($field, $direction = null)
    {
        $order = $this->createOrder($field, $direction);
        $this->order[] = $order;
        return $this;
    }

    public function setMaxResults(int $limit): CriteriaBuilder
    {
        $this->limit = Limit::fromInt($limit);
        return $this;
    }

    public function setFirstResult(int $offset): CriteriaBuilder
    {
        $this->offset = Offset::fromInt($offset);
        return $this;
    }

    private function createFilter(string $field, ?string $operator, string $value, string $conjunction): Filter
    {
        $values = explode('.', $field);
        $entity = "";
        $operator = (empty($operator)) ? FilterOperator::byDefault()->value() : $operator;

        if (count($values) == 2) {
            list($entity, $field) = $values;
        }

        return Filter::fromPrimitives($entity, $field, $value, $operator, $conjunction);
    }

    private function createOrder(string $field, string $direction): Order
    {
        $values = explode('.', $field);
        $entity = "";
        $direction = (empty($direction)) ? OrderDirection::byDefault()->value() : $direction;

        if (count($values) == 2) {
            list($entity, $field) = $values;
        }

        return Order::fromPrimitives($entity, $field, $direction);
    }

    public function build(): Criteria
    {
        $criteria = Criteria::fromValues($this->filters, $this->order, $this->limit, $this->offset);
        $this->reset();

        return $criteria;
    }

    private function reset(): void
    {
        $this->filters = [];
        $this->order = [];
        $this->limit = Limit::byDefault();
        $this->offset = Offset::byDefault();
    }
}