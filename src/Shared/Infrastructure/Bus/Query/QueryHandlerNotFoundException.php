<?php


namespace App\Shared\Infrastructure\Bus\Query;


use App\Shared\Domain\Exception\ErrorException;

final class QueryHandlerNotFoundException extends ErrorException
{
    public static function fromQuery(string $query) {
        return new self('not exists the query handler associated with %query%.', ['%query%' => $query]);
    }
}