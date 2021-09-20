<?php

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Exception\ErrorException;

final class InvalidEventHandlerFormatException extends ErrorException
{
    public static function fromName(string $handler)
    {
        return new self('event name is required in %handler%.', ['%handler%' => $handler]);
    }

    public static function fromType(string $handler)
    {
        return new self('type is required in %handler%.', ['%handler%' => $handler]);
    }

    public static function fromOrder(string $handler)
    {
        return new self('order is required in %handler%.', ['%handler%' => $handler]);
    }
}
