<?php

namespace App\Shared\Infrastructure\Service\Serializer;

interface SerializerInterface
{
    public function serialize(array $object): string;

    public function deserialize(string $object): array;
}
