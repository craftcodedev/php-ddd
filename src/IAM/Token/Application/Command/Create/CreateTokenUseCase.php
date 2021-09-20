<?php


namespace App\IAM\Token\Application\Command\Create;


use App\IAM\Token\Domain\Token;
use App\IAM\Token\Domain\TokenHash;
use App\IAM\Token\Domain\TokenRepositoryInterface;
use App\IAM\Token\Domain\TokenUserId;
use App\Shared\Domain\Bus\Event\EventProvider;

final class CreateTokenUseCase
{
    public function __construct(private TokenRepositoryInterface $tokenRepository, private EventProvider $eventProvider)
    {

    }

    public function __invoke(TokenHash $hash, TokenUserId $userId): void
    {
        $token = Token::create($hash, $userId);

        $this->tokenRepository->add($token);

        $this->eventProvider->record(...$token->releaseEvents());
    }
}