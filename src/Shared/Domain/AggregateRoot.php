<?php

namespace App\Shared\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

abstract class AggregateRoot
{
    private array $events = [];

    protected function record(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->remove();

        return $events;
    }

    private function remove(): void
    {
        $this->events = [];
    }
}
