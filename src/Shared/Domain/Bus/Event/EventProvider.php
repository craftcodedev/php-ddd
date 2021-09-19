<?php


namespace App\Shared\Domain\Bus\Event;


final class EventProvider
{
    public function __construct(private $events = [])
    {
    }

    public function record(DomainEvent ...$events): void
    {
        $this->events = array_merge($this->events, array_values($events));
    }

    public function release(): array
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