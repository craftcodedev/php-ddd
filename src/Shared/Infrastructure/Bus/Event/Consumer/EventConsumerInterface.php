<?php

namespace App\Shared\Infrastructure\Bus\Event\Consumer;

interface EventConsumerInterface
{
    public function consume(): void;
}
