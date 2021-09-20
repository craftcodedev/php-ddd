<?php

namespace App\Shared\Infrastructure\Bus\Command\Middleware;

use App\Shared\Domain\Bus\Command\CommandInterface;

class MiddlewareHandler
{
    protected MiddlewareHandler $nextHandler;

    public function setNext(MiddlewareHandler $handler): void
    {
        $this->nextHandler = $handler;
    }

    public function handle(CommandInterface $command): void
    {
        $this->nextHandler->handle($command);
    }
}
