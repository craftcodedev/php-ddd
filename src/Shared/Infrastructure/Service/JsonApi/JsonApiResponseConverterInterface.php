<?php

namespace App\Shared\Infrastructure\Service\JsonApi;

use App\Shared\Domain\Bus\Query\Response\ResponseInterface;

interface JsonApiResponseConverterInterface
{
    public function convert(ResponseInterface $response): object;
}
