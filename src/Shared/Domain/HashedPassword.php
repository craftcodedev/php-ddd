<?php

namespace App\Shared\Domain;

final class HashedPassword extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
