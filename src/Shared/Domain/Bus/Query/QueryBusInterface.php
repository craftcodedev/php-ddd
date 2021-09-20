<?php

namespace App\Shared\Domain\Bus\Query;

use App\Shared\Domain\Bus\Query\Response\ResponseInterface;

interface QueryBusInterface
{
    public function ask(QueryInterface $query): ResponseInterface;
}
