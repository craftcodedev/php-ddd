<?php

namespace App\Shared\Domain;

use App\Shared\Domain\Bus\Query\Response\ResponseInterface;

abstract class Collection
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add($item)
    {
        $this->items[] = $item;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function clear()
    {
        $this->items = [];
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function first(): ResponseInterface
    {
        return $this->items[0];
    }
}
