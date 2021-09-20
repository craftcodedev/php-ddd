<?php


namespace App\IAM\Token\Infrastructure\Service\Token;


use App\Shared\Domain\Security\Authentication\Payload;

class TokenAdapter
{
    public function __construct(private TokenFacade $tokenFacade)
    {
    }

    public function findPayloadFromEmailAndPasswordAndRole(string $email, string $password, string $role): Payload
    {
        $user = $this->tokenFacade->findUserFromEmailAndPasswordAndRole($email, $password, $role);

        return (new TokenTranslator())->fromRepresentationToPayload($user);
    }
}