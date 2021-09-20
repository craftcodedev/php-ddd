<?php


namespace App\IAM\Token\Domain;


use App\IAM\Token\Domain\Event\TokenCreatedDomainEvent;
use App\Shared\Domain\AggregateRoot;

final class Token extends AggregateRoot
{
    private function __construct(
        private TokenHash $hash,
        private TokenUserId $userId,
        private TokenCreatedAt $createdAt,
        private TokenUpdatedAt $updatedAt
    ) {
    }

    public static function create(
        TokenHash $hash,
        TokenUserId $userId
    ): self {
        $token = new self($hash, $userId, TokenCreatedAt::byDefault(), TokenUpdatedAt::byDefault());

        $token->record(TokenCreatedDomainEvent::create(
            $token->userId()->value(),
            [
                'hash' => $token->hash()->value(),
                'user_id'  => $token->userId()->value(),
                'created_at' => $token->createdAt()->toString(),
                'updated_at' => $token->updatedAt()->toString()
            ]
        ));

        return $token;
    }

    public function userId(): TokenUserId
    {
        return $this->userId;
    }

    public function hash(): TokenHash
    {
        return $this->hash;
    }

    public function createdAt(): TokenCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): TokenUpdatedAt
    {
        return $this->updatedAt;
    }

    public function update(TokenHash $hash)
    {
        $this->hash = $hash;
    }
}