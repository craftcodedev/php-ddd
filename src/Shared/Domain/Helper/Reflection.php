<?php

namespace App\Shared\Domain\Helper;

final class Reflection
{
    public static function methodName(string $method): string
    {
        return substr(strrchr(self::className($method), '::'), 1);
    }

    public static function className(string $class): string
    {
        return substr(strrchr($class, '\\'), 1);
    }

    public static function classNamespace(string $class): string
    {
        return join(array_slice(explode('\\', $class), 0, -1), '\\');
    }

    public static function CountObjectProperties(object $object, $filter = \ReflectionProperty::IS_PRIVATE): int
    {
        $reflect = new \ReflectionClass($object);
        $props = $reflect->getProperties($filter);

        return count($props);
    }
}
