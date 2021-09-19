<?php


namespace App\Shared\Domain\Criteria;


final class Order
{
    private function __construct(private OrderEntity $entity, private OrderField $field, private OrderDirection $direction)
    {
    }

    public static function fromPrimitives(string $entity, string $field, string $direction): Order
    {
        return new Order(
            OrderEntity::fromString($entity),
            OrderField::fromString($field),
            OrderDirection::fromString($direction)
        );
    }

    public function entity(): OrderEntity
    {
        return $this->entity;
    }

    public function field(): OrderField
    {
        return $this->field;
    }

    public function direction(): OrderDirection
    {
        return $this->direction;
    }
}