<?php


namespace App\Shared\Infrastructure\Bus\Event\Serializer;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\InvalidDomainEventException;

final class GenericDomainEvent extends DomainEvent
{
    public function __construct(
        string $aggregateId,
        array $body,
        string $id = null,
        string $occurredOn = null,
        private string $origin = '',
        private string $name = '',
        private string $version = ''
    ) {
        parent::__construct($aggregateId, $body, $id, $occurredOn);
    }

    protected function setBody(array $body): void
    {
        if (!isset($body['name'])) {
            throw InvalidDomainEventException::fromBody($this->name(), 'name');
        }

        $this->body = $body;
    }

    public static function fromData(array $data): self
    {
        $aggregateId = $data['body']['id'];
        unset($data['body']['id']);
        $body = $data['body'];
        $id = $data['id'];
        $occurredOn = $data['occurred_on'];
        $origin = $data['origin'];
        $name = $data['name'];
        $version = $data['version'];

        return new self($aggregateId, $body, $id, $occurredOn, $origin, $name, $version);
    }

    public static function create(string $aggregateId, array $body, $id = null, string $occurredOn = null): self
    {
        return new self($aggregateId, $body, $id. $occurredOn);
    }

    public function origin(): string
    {
        return $this->origin;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function version(): string
    {
        return $this->version;
    }
}