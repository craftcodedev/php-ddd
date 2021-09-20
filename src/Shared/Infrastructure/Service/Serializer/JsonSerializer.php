<?php

namespace App\Shared\Infrastructure\Service\Serializer;

use App\Shared\Domain\Exception\ErrorException;

final class JsonSerializer implements SerializerInterface
{
    public function serialize(array $object): string
    {
        return json_encode($object);
    }

    public function deserialize(string $object): array
    {
        $data = json_decode($object, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new ErrorException('Unable to parse response as JSON: ' . json_last_error());
        }

        return $data;
    }
}
