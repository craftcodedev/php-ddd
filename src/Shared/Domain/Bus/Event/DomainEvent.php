<?php


namespace App\Shared\Domain\Bus\Event;


use App\Shared\Domain\Identifier;

abstract class DomainEvent
{
    private string $id;
    protected array $body;
    private string $occurredOn;

    protected function __construct(private string $aggregateId, array $body, string $id = null, string $occurredOn = null)
    {
        $this->setBody($body);
        $this->id = $id ?: Identifier::generate()->value();
        $this->occurredOn = $occurredOn ?: OccurredOn::fromDateTime(new \DateTime())->toString();
    }

    abstract public static function create(string $aggregateId, array $body, $id = null, string $occurredOn = null): self;

    abstract protected function setBody(array $body): void;

    abstract public function origin(): string;
    abstract public function name(): string;
    abstract public function version(): string;

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function body(): array
    {
        return $this->body;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function occurredOn(): string
    {
        return $this->occurredOn;
    }
}