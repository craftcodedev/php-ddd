<?php

namespace App\Shared\Domain\Bus\Event;

interface EventBusInterface
{
    public function dispatch(DomainEvent $event): void;
}
