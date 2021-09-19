<?php


namespace App\Shared\Infrastructure\Bus\Event\Publisher;


use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Infrastructure\Bus\Event\Serializer\EventSerializer;

final class GoogleEventPublisher implements EventPublisherInterface
{
    //private PubSubClient $pubSub;

    public function __construct(
        private EventSerializer $eventSerializer,
        private DatabaseEventPublisher $failedEventPublisher,
        //GoogleConfig $config
    ) {
        //$this->pubSub = new PubSubClient($config->google());
    }

    public function publish(DomainEvent $event): void
    {
        $eventJson = $this->eventSerializer->serialize($event);

        /**try {
            $topic = $this->pubSub->topic('events');

            $topic->publish([
                'data' => 'Event '.$event->name(),
                'attributes' => $eventJson
            ]);
        } catch (\Exception $e) {
            $this->failedEventPublisher->publish($event);
            throw $e;
        }**/
    }
}