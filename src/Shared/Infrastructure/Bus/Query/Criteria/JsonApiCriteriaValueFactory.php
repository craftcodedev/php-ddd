<?php


namespace App\Shared\Infrastructure\Bus\Query\Criteria;

use App\Shared\Domain\Bus\Query\Criteria\CriteriaValueFactoryInterface;
use App\Shared\Domain\Criteria\Filter;
use App\Shared\Domain\Criteria\Limit;
use App\Shared\Domain\Criteria\Offset;
use App\Shared\Domain\Criteria\Order;

final class JsonApiCriteriaValueFactory implements CriteriaValueFactoryInterface
{
    public function __construct(private array $parameters)
    {
    }

    public function createFilters(): array
    {
        $filterCollection = [];
        $filters = (isset($this->parameters['filter'])) ? $this->parameters['filter'] : [];

        foreach ($filters as $key => $value) {
            list ($entity, $field) = explode('.', $key);
            $operator = null;
            $conjunction = null;

            if (is_array($value))  {
                $operator = array_key_first($value);
                $value = $value[$operator];
            }

            $filterCollection[] = Filter::fromPrimitives($entity, $field, $value, $operator, $conjunction);
        }

        return $filterCollection;
    }

    public function createOrder(): array
    {
        $order = [];
        $sort = (isset($this->parameters['sort'])) ? explode(',', $this->parameters['sort']) : [];

        foreach ($sort as $value) {
            $entity = '';
            $direction = (str_contains($value, '-')) ? '-' : '+';
            $values = explode('.', str_replace($direction, '', $value));
            $field = $values[0];

            if (count($values) === 2) {
                $entity = $values[0];
                $field = $values[1];
            }

            $order[] = Order::fromPrimitives($entity, $field, $direction);
        }

        return $order;
    }

    public function createLimit(): Limit
    {
        $page = (isset($this->parameters['page'])) ? $this->parameters['page'] : [];
        return (isset($page['size'])) ? Limit::fromInt($page['size']) : Limit::byDefault();
    }

    public function createOffset(): Offset
    {
        $page = (isset($this->parameters['page'])) ? $this->parameters['page'] : [];
        return (isset($page['size'])) ? Offset::fromInt((($page['number']-1) * $page['size'])) : Offset::byDefault();
    }
}