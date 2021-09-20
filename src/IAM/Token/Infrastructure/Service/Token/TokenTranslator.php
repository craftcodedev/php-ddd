<?php


namespace App\IAM\Token\Infrastructure\Service\Token;


use App\Shared\Domain\Bus\Query\Response\ResponseInterface;
use App\Shared\Domain\Security\Authentication\Payload;

final class TokenTranslator
{
    public function fromRepresentationToPayload(ResponseInterface $user): Payload
    {
        return Payload::fromValues(
            $user->id(),
            $user->email(),
            $user->firstName(),
            $user->lastName(),
            $user->phone(),
            $user->roles(),
            $user->status(),
            $user->createdAt(),
            $user->updatedAt(),
        );
    }
}