<?php


namespace App\Shared\Domain\Bus\Query\Response;


abstract class AggregateRootsResponseConverter
{
    protected function __construct(private ResponseConverterInterface $responseConverter)
    {
    }

    public function convert(array $aggregateRoots, array $resources = []): AggregateRootsResponse
    {
        $aggregateRootsResponse = new AggregateRootsResponse();

        foreach ($aggregateRoots as $k => $v) {
            $aggregateRootsResponse->add(
                $this->responseConverter->convert($aggregateRoots[$k], $resources)
            );
        }

        return $aggregateRootsResponse;
    }
}