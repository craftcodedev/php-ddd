<?php

namespace App\Shared\Infrastructure\Bus\Command;

use App\Shared\Domain\Bus\Command\CommandHandlerInterface;

final class CommandHandlerRepository
{
    private array $handlers;

    public function __construct(iterable $handlers)
    {
        $this->setHandlers($handlers);
    }

    private function setHandlers(iterable $handlers): void
    {
        /** @var CommandHandlerInterface $handler */
        foreach (iterator_to_array($handlers) as $handler) {
            $commandHandlerName = get_class($handler);
            $command = str_replace('CommandHandler', 'Command', $commandHandlerName);
            $this->handlers[$command] = $handler;
        }
    }

    public function findByCommand(string $command): CommandHandlerInterface
    {
        if (!isset($this->handlers[$command])) {
            throw CommandHandlerNotFoundException::fromCommand($command);
        }

        return $this->handlers[$command];
    }
}
