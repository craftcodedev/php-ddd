<?php


namespace App\Shared\Infrastructure\Bus\Command;


use App\Shared\Domain\Bus\Command\CommandBusInterface;
use App\Shared\Domain\Bus\Command\CommandHandlerInterface;
use App\Shared\Domain\Bus\Command\CommandInterface;
use App\Shared\Domain\Security\Authorization\AuthorizationInterface;
use App\Shared\Infrastructure\Bus\Command\Middleware\CommandHandlerMiddleware;
use App\Shared\Infrastructure\Bus\Command\Middleware\MiddlewareHandler;
use App\Shared\Infrastructure\Security\Authorization\AuthorizationRepository;

final class CommandBus implements CommandBusInterface
{
    private array $handlers;

    public function __construct(
        private AuthorizationRepository $authorizationRepository,
        private CommandHandlerRepository $commandHandlerRepository,
        iterable $middlewareHandlers
    ) {
        $this->handlers = iterator_to_array($middlewareHandlers);
    }

    public function dispatch(CommandInterface $command): void
    {
        $commandClass = get_class($command);
        $authorization = $this->authorizationRepository->findByCommand($commandClass);
        $commandHandler = $this->commandHandlerRepository->findByCommand($commandClass);
        $middlewareHandler = $this->middlewareHandler($authorization, $commandHandler);
        $middlewareHandler->handle($command);
    }

    private function middlewareHandler(
        AuthorizationInterface $authorization,
        CommandHandlerInterface $commandHandler
    ): MiddlewareHandler {
        $middlewareHandler = null;

        foreach ($this->handlers as $handler) {
            if (empty($middlewareHandler)) {
                $commandHandlerMiddleware = new CommandHandlerMiddleware($authorization, $commandHandler);
                $middlewareHandler = $handler;
                $middlewareHandler->setNext($commandHandlerMiddleware);
                continue;
            }

            $handler->setNext($middlewareHandler);
            $middlewareHandler = $handler;
        }

        return $middlewareHandler;
    }
}