<?php


namespace App\Tests\Shared\Domain\Bus\Event;


use App\Shared\Domain\Bus\Event\DomainEvent;

final class DomainEventFake extends DomainEvent
{
    public function __construct(
        string $aggregateId,
        array $body,
        string $id = null,
        string $occurredOn = null
    ) {
        parent::__construct($aggregateId, $body, $id, $occurredOn);
    }

    protected function setBody(array $body): void
    {
        $this->body = $body;
    }

    public static function create(string $aggregateId, array $body, $id = null, string $occurredOn = null): self
    {
        return new self($aggregateId, $body, $id. $occurredOn);
    }

    public function origin(): string
    {
        return 'shared';
    }

    public function name(): string
    {
        return 'fake';
    }

    public function version(): string
    {
        return '1';
    }
}