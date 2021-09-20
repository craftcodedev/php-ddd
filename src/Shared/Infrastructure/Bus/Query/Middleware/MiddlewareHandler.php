<?php

namespace App\Shared\Infrastructure\Bus\Query\Middleware;

use App\Shared\Domain\Bus\Query\QueryInterface;
use App\Shared\Domain\Bus\Query\Response\ResponseInterface;

class MiddlewareHandler
{
    protected MiddlewareHandler $nextHandler;

    public function setNext(MiddlewareHandler $handler): void
    {
        $this->nextHandler = $handler;
    }

    public function handle(QueryInterface $request): ResponseInterface
    {
        return $this->nextHandler->handle($request);
    }
}
