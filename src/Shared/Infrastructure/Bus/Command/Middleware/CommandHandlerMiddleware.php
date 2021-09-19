<?php


namespace App\Shared\Infrastructure\Bus\Command\Middleware;


use App\Shared\Domain\Bus\Command\CommandHandlerInterface;
use App\Shared\Domain\Bus\Command\CommandInterface;
use App\Shared\Domain\Security\Authorization\AuthorizationInterface;

final class CommandHandlerMiddleware extends MiddlewareHandler {
    public function __construct(
        private AuthorizationInterface $authorization,
        private CommandHandlerInterface $commandHandler
    ) {}

    public function handle(CommandInterface $command): void {
        $this->authorization->authorize($command);
        $this->commandHandler->handle($command);
    }
}