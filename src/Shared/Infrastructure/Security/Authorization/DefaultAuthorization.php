<?php

namespace App\Shared\Infrastructure\Security\Authorization;

use App\Shared\Domain\Security\Authorization\AuthorizationInterface;

final class DefaultAuthorization implements AuthorizationInterface
{
    public function authorize($request): void
    {
    }
}
