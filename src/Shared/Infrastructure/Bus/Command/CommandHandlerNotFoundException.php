<?php

namespace App\Shared\Infrastructure\Bus\Command;

use App\Shared\Domain\Exception\ErrorException;

final class CommandHandlerNotFoundException extends ErrorException
{
    public static function fromCommand(string $command)
    {
        return new self('not exists the query handler associated with %command%.', ['%command%' => $command]);
    }
}
