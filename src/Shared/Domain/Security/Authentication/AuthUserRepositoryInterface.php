<?php

namespace App\Shared\Domain\Security\Authentication;

interface AuthUserRepositoryInterface
{
    public function get(): AuthUser;
}
