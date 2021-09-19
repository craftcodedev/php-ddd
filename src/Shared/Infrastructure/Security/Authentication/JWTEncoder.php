<?php


namespace App\Shared\Infrastructure\Security\Authentication;


use App\Shared\Domain\Security\Authentication\JWTEncoderInterface;
use App\Shared\Domain\Security\Authentication\Payload;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWSProvider\JWSProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class JWTEncoder implements JWTEncoderInterface
{
    public function __construct(private JWSProviderInterface $jwsProvider, private RequestStack $requestStack)
    {
    }

    public function encode(Payload $payload, array $header = []): string
    {
        try {
            $jws = $this->jwsProvider->create(
                [
                    'id' => $payload->userId(),
                    'email' => $payload->email(),
                    'first_name' => $payload->firstName(),
                    'last_name' => $payload->lastName(),
                    'username' => $payload->username(),
                    'phone' => $payload->phone(),
                    'roles' => explode(',', $payload->roles()),
                    'status' => $payload->status(),
                    'created_at' => $payload->createdAt(),
                    'updated_at' => $payload->updatedAt(),
                ],
                $header
            );
        } catch (\InvalidArgumentException $e) {
            throw new JWTEncodeFailureException(JWTEncodeFailureException::INVALID_CONFIG, 'An error occurred while trying to encode the JWT token. Please verify your configuration (private key/passphrase)', $e);
        }

        if (!$jws->isSigned()) {
            throw new JWTEncodeFailureException(JWTEncodeFailureException::UNSIGNED_TOKEN, 'Unable to create a signed JWT from the given configuration.');
        }

        return $jws->getToken();
    }

    public function decode(string $token): Payload
    {
        try {
            $jws = $this->jwsProvider->load($token);
        } catch (\Exception $e) {
            throw new JWTDecodeFailureException(JWTDecodeFailureException::INVALID_TOKEN, 'Invalid JWT Token', $e);
        }

        if ($jws->isInvalid()) {
            throw new JWTDecodeFailureException(JWTDecodeFailureException::INVALID_TOKEN, 'Invalid JWT Token');
        }

        $payload = $jws->getPayload();

        return Payload::fromValues(
            $payload['id'],
            $payload['email'],
            $payload['first_name'],
            $payload['last_name'],
            $payload['phone'],
            $payload['roles'],
            $payload['status'],
            $payload['created_at'],
            $payload['updated_at'],
        );
    }
}