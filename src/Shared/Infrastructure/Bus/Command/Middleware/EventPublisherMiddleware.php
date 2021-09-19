<?php


namespace App\Shared\Infrastructure\Bus\Command\Middleware;


use App\Shared\Domain\Bus\Command\CommandInterface;
use App\Shared\Domain\Bus\Event\EventProvider;

final class EventPublisherMiddleware extends MiddlewareHandler
{
    private array $eventPublishers;

    public function __construct(private EventProvider $eventProvider, iterable $eventPublishers)
    {
        $this->eventPublishers = iterator_to_array($eventPublishers);
    }

    public function handle(CommandInterface $command): void
    {
        $this->nextHandler->handle($command);

        $events = $this->eventProvider->release();

        foreach ($events as $event) {
            foreach ($this->eventPublishers as $eventPublisher) {
                try {
                    $eventPublisher->publish($event);
                } catch (\Exception $exception) {
                    //TODO save failed event publisher
                }
            }
        }
    }
}