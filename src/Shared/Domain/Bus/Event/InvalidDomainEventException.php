<?php


namespace App\Shared\Domain\Bus\Event;


use App\Shared\Domain\Exception\ErrorException;

final class InvalidDomainEventException extends ErrorException
{
    public static function fromBody(string $eventName, string $bodyAttribute) {
        return new self('%eventName% event must have %attribute% as body\'s attributes', ['%eventName%' => $eventName, '%attribute%' => $bodyAttribute]);
    }
}