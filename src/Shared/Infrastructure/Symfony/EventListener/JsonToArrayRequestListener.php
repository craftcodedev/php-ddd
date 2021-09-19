<?php


namespace App\Shared\Infrastructure\Symfony\EventListener;

use App\Shared\Domain\Helper\Inflector;
use App\Shared\Infrastructure\Service\Serializer\SerializerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class JsonToArrayRequestListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => 'onKernelRequest'
        );
    }

    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->getMethod() === Request::METHOD_GET) {
            return;
        }

        $content = $request->getContent(false);

        if (!$this->isJson($content)) {
            return;
        }

        $content = new ParameterBag($this->deserialize($content));
        $request->request = $content;
    }

    public function onKernelRequests(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->getMethod() !== Request::METHOD_GET) {
            $content = $request->getContent(false);

            if ($this->isJson($content)) {
                $content = new ParameterBag($this->deserialize($content));
                $request->request = $content;
            }
        }
    }

    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }

    private function deserialize(string $content)
    {
        $data = $this->serializer->deserialize($content);

        return $this->decamelize($data);
    }

    private function decamelize(array $data)
    {
        $newArray = array();

        foreach ($data as $k => $v) {
            $value = $data[$k];

            if (is_array($data[$k])) {
                $value = self::decamelize($data[$k]);
            }

            $key = Inflector::fromCamelCaseToSnakeCase($k);

            $newArray[$key] = $value;
        }

        return $newArray;
    }
}