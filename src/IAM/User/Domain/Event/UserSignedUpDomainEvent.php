<?php


namespace App\IAM\User\Domain\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\InvalidDomainEventException;

final class UserSignedUpDomainEvent extends DomainEvent
{
    public const NAME =  'user_signed_up';

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
        if (empty($body['email'])) {
            throw InvalidDomainEventException::fromBody($this->name(), 'email');
        }

        if (empty($body['first_name'])) {
            throw InvalidDomainEventException::fromBody($this->name(), 'first_name');
        }

        if (empty($body['last_name'])) {
            throw InvalidDomainEventException::fromBody($this->name(), 'last_name');
        }

        if (empty($body['phone'])) {
            throw InvalidDomainEventException::fromBody($this->name(), 'phone');
        }

        if (empty($body['roles'])) {
            throw InvalidDomainEventException::fromBody($this->name(), 'roles');
        }

        if (empty($body['status'])) {
            throw InvalidDomainEventException::fromBody($this->name(), 'status');
        }

        if (empty($body['created_at'])) {
            throw InvalidDomainEventException::fromBody($this->name(), 'created_at');
        }

        if (empty($body['updated_at'])) {
            throw InvalidDomainEventException::fromBody($this->name(), 'updated_at');
        }

        $this->body = $body;
    }

    public static function create(string $aggregateId, array $body, $id = null, string $occurredOn = null): self
    {
        return new self($aggregateId, $body, $id. $occurredOn);
    }

    public function origin(): string
    {
        return 'iam.user';
    }

    public function name(): string
    {
        return self::NAME;
    }

    public function version(): string
    {
        return '1';
    }
}