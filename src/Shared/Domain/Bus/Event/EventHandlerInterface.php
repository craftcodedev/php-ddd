<?php

namespace App\Shared\Domain\Bus\Event;

interface EventHandlerInterface
{
    public function subscribeTo(): array;

    public function handle(DomainEvent $event): void;
}
