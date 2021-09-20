<?php


namespace App\IAM\Token\Domain\Event;


use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\InvalidDomainEventException;

class TokenCreatedDomainEvent extends DomainEvent
{
    public const NAME =  'token_created';

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
        if (empty($body['hash'])) {
            throw InvalidDomainEventException::fromBody($this->name(), 'hash');
        }

        if (empty($body['user_id'])) {
            throw InvalidDomainEventException::fromBody($this->name(), 'user_id');
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