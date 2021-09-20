<?php


namespace App\IAM\Token\Application\Command\Create;


use App\IAM\Token\Domain\TokenHash;
use App\IAM\Token\Domain\TokenUserId;
use App\IAM\Token\Infrastructure\Service\Token\TokenAdapter;
use App\Shared\Domain\Bus\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\Authentication\JWTEncoderInterface;

final class CreateTokenCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TokenAdapter $tokenAdapter,
        private JWTEncoderInterface $jwtEncoder,
        private CreateTokenUseCase $createTokenUseCase
    ) {
    }

    public function handle(CreateTokenCommand $command): void
    {
        $payload = $this->tokenAdapter->findPayloadFromEmailAndPasswordAndRole(
            $command->email(),
            $command->password(),
            $command->role()
        );
        $hash = TokenHash::fromString($this->jwtEncoder->encode($payload));
        $userId = TokenUserId::fromString($payload->userId());

        $this->createTokenUseCase->__invoke($hash, $userId);
    }
}