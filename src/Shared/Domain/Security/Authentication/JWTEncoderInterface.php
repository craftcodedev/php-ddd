<?php

namespace App\Shared\Domain\Security\Authentication;

interface JWTEncoderInterface
{
    public function encode(Payload $payload): string;

    public function decode(string $token): Payload;
}
