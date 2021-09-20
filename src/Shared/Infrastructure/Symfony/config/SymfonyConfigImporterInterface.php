<?php

namespace App\Shared\Infrastructure\Symfony\config;

interface SymfonyConfigImporterInterface
{
    public function __invoke(string $path);
}
