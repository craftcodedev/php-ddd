<?php


namespace App\Shared\Infrastructure\Bus\Command\Middleware\Exception;


use App\Shared\Domain\Exception\ValidationException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

final class ResourceAlreadyExistsException extends ValidationException
{
    public static function fromDoctrineException(UniqueConstraintViolationException $e): \Exception
    {
        $message = explode('INSERT INTO', $e->getMessage());

        if (count($message) === 1) {
            throw $e;
        }

        $message = explode('(', $message[1]);

        if (count($message) === 1) {
            throw $e;
        }

        $resourceName = trim($message[0]);

        $message = $e->getMessage();
        $message = explode('Duplicate entry', $message);

        if (count($message) === 1) {
            throw $e;
        }

        $message = explode(' for key ', $message[1]);

        if (count($message) === 1) {
            throw $e;
        }

        list ($value, $field) = $message;

        if ($field == "'PRIMARY'") {
            $field = 'id';
        } elseif (strpos($field, '_unique') !== false) {
            $field = ltrim(explode("_unique'", $field)[0], "'");
        } elseif (strpos($field, 'unique_') !== false) {
            $field = rtrim(explode("'unique_", $field)[1], "'");
        }

        return new self(sprintf('%s already exists with the %s (%s).', $resourceName, $field, $value));
    }
}