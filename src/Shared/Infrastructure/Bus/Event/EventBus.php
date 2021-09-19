<?php


namespace App\Shared\Infrastructure\Bus\Event;


use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBusInterface;

final class EventBus implements EventBusInterface
{
    public function __construct(
        private EventHandlerRepository $eventHandlerRepository
    ) {
    }

    public function dispatch(DomainEvent $event): void {
        $handlers = $this->eventHandlerRepository->findByEventNameAndEventType($event->name());

        foreach ($handlers as $handler) {
            $handler->handle($event);
        }
    }
}