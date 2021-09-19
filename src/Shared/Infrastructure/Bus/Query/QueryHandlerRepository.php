<?php


namespace App\Shared\Infrastructure\Bus\Query;


use App\Shared\Domain\Bus\Query\QueryHandlerInterface;

final class QueryHandlerRepository
{
    private array $handlers;

    public function __construct(iterable $handlers)
    {
        $this->setHandlers($handlers);
    }

    private function setHandlers(iterable $handlers): void
    {
        /** @var QueryHandlerInterface $handler */
        foreach (iterator_to_array($handlers) as $handler) {
            $queryHandlerName = get_class($handler);
            $query = str_replace("QueryHandler", "Query", $queryHandlerName);
            $this->handlers[$query] = $handler;
        }
    }

    public function findByQuery(string $query): QueryHandlerInterface {
        if (!isset($this->handlers[$query])) {
            throw QueryHandlerNotFoundException::fromQuery($query);
        }

        return $this->handlers[$query];
    }
}