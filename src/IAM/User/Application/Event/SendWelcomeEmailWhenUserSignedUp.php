<?php


namespace App\IAM\User\Application\Event;


use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventHandlerInterface;

final class SendWelcomeEmailWhenUserSignedUp implements EventHandlerInterface
{
    public function subscribeTo(): array
    {
        return ['name' => 'user_signed_up', 'type' => 'sync', 'order' => 1];
    }

    public function handle(DomainEvent $event): void
    {
    }
}