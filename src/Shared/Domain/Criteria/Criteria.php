<?php


namespace App\Shared\Domain\Criteria;


final class Criteria
{
    private function __construct(
        private array $filters,
        private array $order,
        private Limit $limit,
        private Offset $offset
    ) {
    }

    public static function fromValues(
        array $filters,
        array $order = [],
        Limit $limit = null,
        Offset $offset = null
    ): self {
        return new self(
            $filters,
            $order,
            (empty($limit)) ? Limit::byDefault() : $limit,
            (empty($offset)) ? Offset::byDefault() : $offset
        );
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function order(): array
    {
        return $this->order;
    }

    public function limit(): Limit
    {
        return $this->limit;
    }

    public function offset(): Offset
    {
        return $this->offset;
    }
}