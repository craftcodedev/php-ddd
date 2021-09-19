<?php


namespace App\Shared\Domain;


abstract class StringValueObject
{
    protected string $value;

    abstract protected function __construct(string $value);

    public function equals(self $stringValueObject)
    {
        return ($this->value() === $stringValueObject->value());
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}