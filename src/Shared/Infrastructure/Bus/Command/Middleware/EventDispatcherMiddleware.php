<?php


namespace App\Shared\Infrastructure\Bus\Command\Middleware;


use App\Shared\Domain\Bus\Command\CommandInterface;
use App\Shared\Domain\Bus\Event\EventProvider;
use App\Shared\Infrastructure\Bus\Event\EventHandlerRepository;

final class EventDispatcherMiddleware extends MiddlewareHandler
{
    public function __construct(private EventProvider $eventProvider, private EventHandlerRepository $eventHandlerRepository)
    {
    }

    public function handle(CommandInterface $command): void
    {
        $this->nextHandler->handle($command);

        $events = $this->eventProvider->release();

        foreach ($events as $event) {
            $handlers = $this->eventHandlerRepository->findByEventNameAndEventType($event->name(), 'sync');

            foreach ($handlers as $handler) {
                $handler->handle($event);
            }
        }

        $this->recordEventsToEventPublisherMiddleware($events);
    }

    private function recordEventsToEventPublisherMiddleware(array $events)
    {
        $this->eventProvider->record(...$events);
    }
}