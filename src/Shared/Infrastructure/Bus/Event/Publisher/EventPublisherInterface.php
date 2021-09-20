<?php

namespace App\Shared\Infrastructure\Bus\Event\Publisher;

use App\Shared\Domain\Bus\Event\DomainEvent;

interface EventPublisherInterface
{
    public function publish(DomainEvent $event): void;
}
