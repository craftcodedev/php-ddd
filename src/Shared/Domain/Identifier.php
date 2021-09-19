<?php


namespace App\Shared\Domain;


use App\Shared\Domain\Exception\InvalidIdentifierException;
use Ramsey\Uuid\Uuid;

class Identifier extends StringValueObject
{
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw InvalidIdentifierException::fromEmpty('Identifier');
        }

        if (!self::is($value)) {
            throw InvalidIdentifierException::fromValue('Identifier', $value);
        }

        $this->value = $value;
    }

    public static function is(string $value): bool
    {
        $UUIDv4Pattern = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

        if (!preg_match($UUIDv4Pattern, $value)) {
            return false;
        }

        return true;
    }

    public static function generate(): static
    {
        return new static(Uuid::uuid4()->toString());
    }
}