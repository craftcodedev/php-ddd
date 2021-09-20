<?php

namespace App\Shared\Domain\Helper;

final class Inflector
{
    public static function fromSnakeCaseToCamelCase(string $word): string
    {
        return lcfirst(str_replace([' ', '_', '-'], '', ucwords($word, ' _-')));
    }

    public static function fromCamelCaseToSnakeCase(string $word): string
    {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $word));
    }
}
