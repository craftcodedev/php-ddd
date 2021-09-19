<?php


namespace App\Shared\Domain;


abstract class IntValueObject
{
    protected int $value;

    abstract protected function __construct(int $value);

    public function equals(self $stringValueObject)
    {
        return ($this->value() === $stringValueObject->value());
    }

    public static function fromInt(int $value): static
    {
        return new static($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}