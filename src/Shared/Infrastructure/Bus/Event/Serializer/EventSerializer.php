<?php


namespace App\Shared\Infrastructure\Bus\Event\Serializer;


use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Exception\ErrorException;
use App\Shared\Infrastructure\Service\Serializer\SerializerInterface;

final class EventSerializer
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function serialize(DomainEvent $event): string
    {
        return $this->serializer->serialize([
            'id' => $event->id(),
            'origin' => $event->origin(),
            'name' => $event->name(),
            'version' => $event->version(),
            'body' => array_merge(['id' => $event->aggregateId()], $event->body()),
            'occurred_on' => $event->occurredOn(),
        ]);
    }

    public function deserialize(string $event): DomainEvent
    {
        $data = $this->serializer->deserialize($event);

        if (!isset($data['id'], $data['origin'], $data['name'], $data['version'], $data['body'], $data['occurred_on'])) {
            throw new ErrorException('Cannot reconstruct domain event. id, body, origin, name, version, body, ocurredOn fields are missing');
        }

        return GenericDomainEvent::fromData($data);
    }
}