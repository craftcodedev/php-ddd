<?php

namespace App\Shared\Infrastructure\Bus\Command\Middleware;

use App\Shared\Domain\Bus\Command\CommandInterface;
use App\Shared\Infrastructure\Bus\Command\Middleware\Exception\ResourceAlreadyExistsException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

final class CustomizeExceptionMiddleware extends MiddlewareHandler
{
    public function handle(CommandInterface $command): void
    {
        try {
            $this->nextHandler->handle($command);
        } catch (UniqueConstraintViolationException $exception) {
            throw ResourceAlreadyExistsException::fromDoctrineException($exception);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
