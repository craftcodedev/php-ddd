<?php


namespace App\Shared\Infrastructure\Bus\Event;


use App\Shared\Domain\Bus\Event\EventHandlerInterface;

final class EventHandlerRepository
{
    private array $handlers;

    public function __construct(iterable $handlers)
    {
        $this->setHandlers($handlers);
    }

    private function setHandlers(iterable $handlers): void
    {
        /** @var EventHandlerInterface $handler */
        foreach (iterator_to_array($handlers) as $handler) {
            $event = $handler->subscribeTo();

            if (empty($event['name'])) {
                throw InvalidEventHandlerFormatException::fromName(get_class($handler));
            }

            if (empty($event['type'])) {
                throw InvalidEventHandlerFormatException::fromType(get_class($handler));
            }

            if (empty($event['order'])) {
                throw InvalidEventHandlerFormatException::fromOrder(get_class($handler));
            }

            $name = $event['name'];
            $type = $event['type'];
            $order = $event['order'];

            if (isset($this->handlers[$name][$type])) {
                $order = (isset($this->handlers[$name][$type][$order])) ? count($this->handlers[$name][$type]) + 1 : $order;
                $this->handlers[$name][$type][$order] = $handler;
                continue;
            }

            $this->handlers[$name][$type][$order] = $handler;
        }
    }

    public function findByEventNameAndEventType(string $name, string $type = 'async'): array
    {
        if (isset($this->handlers[$name][$type])) {
            return $this->handlers[$name][$type];
        }

        return [];
    }
}