<?php

namespace App\Shared\Infrastructure\Bus\Command\Middleware\Exception;

use App\Shared\Domain\Exception\ValidationException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

final class ResourceAlreadyExistsException extends ValidationException
{
    public static function fromDoctrineException(UniqueConstraintViolationException $e): \Exception
    {
        $message = explode('INSERT INTO', $e->getMessage());

        if (1 === count($message)) {
            throw $e;
        }

        $message = explode('(', $message[1]);

        if (1 === count($message)) {
            throw $e;
        }

        $resourceName = trim($message[0]);

        $message = $e->getMessage();
        $message = explode('Duplicate entry', $message);

        if (1 === count($message)) {
            throw $e;
        }

        $message = explode(' for key ', $message[1]);

        if (1 === count($message)) {
            throw $e;
        }

        list($value, $field) = $message;

        if ("'PRIMARY'" == $field) {
            $field = 'id';
        } elseif (false !== strpos($field, '_unique')) {
            $field = ltrim(explode("_unique'", $field)[0], "'");
        } elseif (false !== strpos($field, 'unique_')) {
            $field = rtrim(explode("'unique_", $field)[1], "'");
        }

        return new self(sprintf('%s already exists with the %s (%s).', $resourceName, $field, $value));
    }
}
