<?php


namespace App\Shared\Infrastructure\Bus\Event\Publisher;


use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Infrastructure\Service\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;

final class DatabaseEventPublisher implements EventPublisherInterface
{
    private Connection $connection;

    public function __construct(
        EntityManagerInterface $entityManager,
        private SerializerInterface $serializer
    ) {
        $this->connection = $entityManager->getConnection();
    }

    public function publish(DomainEvent $event): void
    {
        $id = $this->connection->quote($event->id());
        $origin = $this->connection->quote($event->origin());
        $name = $this->connection->quote($event->name());
        $aggregateId = $this->connection->quote($event->aggregateId());
        $body = $this->connection->quote($this->serializer->serialize($event->body()));
        $version = $this->connection->quote($event->version());
        $occurredOn = $this->connection->quote($event->occurredOn());

        $this->connection->executeQuery("INSERT INTO domain_event 
            VALUES ($id, $origin, $name, $aggregateId, $body, $version, $occurredOn)"
        );
    }
}

