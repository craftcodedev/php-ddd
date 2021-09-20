<?php


namespace App\IAM\Token\Application\Event;


use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventHandlerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class SetTokenToHeaderWhenTokenCreatedHandler implements EventHandlerInterface
{
    public function __construct(private RequestStack $requestStack)
    {

    }
    public function subscribeTo(): array
    {
        return ['name' => 'token_created', 'type' => 'sync', 'order' => 1];
    }

    public function handle(DomainEvent $event): void
    {
        $body = $event->body();
        $request = $this->requestStack->getCurrentRequest();
        $request->headers->add(['Authorization' => $body['hash']]);
    }
}