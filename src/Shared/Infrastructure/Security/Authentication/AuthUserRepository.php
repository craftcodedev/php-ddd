<?php


namespace App\Shared\Infrastructure\Security\Authentication;


use App\Shared\Domain\Security\Authentication\AuthUser;
use App\Shared\Domain\Security\Authentication\AuthUserRepositoryInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\InvalidTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class AuthUserRepository implements AuthUserRepositoryInterface
{
    public function __construct(private TokenStorageInterface $tokenStorage)
    {

    }
    public function get(): AuthUser
    {
        $token = $this->tokenStorage->getToken();

        if (!$token instanceof TokenInterface) {
            throw new InvalidTokenException('Invalid token');
        }

        $jwtUser = $token->getUser();

        if (!$jwtUser instanceof JWTUserInterface) {
            throw new InvalidTokenException('Invalid token');
        }

        return AuthUser::fromValues($jwtUser->id(), $jwtUser->email(), $jwtUser->firstName(), $jwtUser->lastName(), $jwtUser->roles());
    }
}