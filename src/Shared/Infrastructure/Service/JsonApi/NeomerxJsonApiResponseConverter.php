<?php


namespace App\Shared\Infrastructure\Service\JsonApi;


use App\Shared\Domain\Bus\Query\Response\AggregateRootsResponse;
use App\Shared\Domain\Bus\Query\Response\ResponseInterface;
use App\Shared\Domain\Helper\Reflection;
use App\Shared\Domain\Identifier;
use Neomerx\JsonApi\Encoder\Encoder;
use Symfony\Component\HttpFoundation\RequestStack;

final class NeomerxJsonApiResponseConverter implements JsonApiResponseConverterInterface
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    public function convert(ResponseInterface $response): Object
    {
        $encoder = Encoder::instance($this->schema($response));
        $result = $encoder->withEncodeOptions(JSON_PRETTY_PRINT)
            ->withUrlPrefix($this->urlPrefix())
            ->withLinks(array())
            ->withMeta(array())
            //->withIncludedPaths($query->resources())
            ->encodeData($this->data($response));

        return json_decode($result);
    }

    private function schema(ResponseInterface $response): array
    {
        $canonicalNameResponse = get_class($response);

        if ($response instanceof AggregateRootsResponse && $response->count() === 0) {
            return [];
        }

        if ($response instanceof AggregateRootsResponse) {
            $canonicalNameResponse = get_class($response->first());
        }

        $className = Reflection::className($canonicalNameResponse);
        $canonicalNameSchema = str_replace("Application\\Query\\Response\\".$className, 'UI\\HTTP\\Rest\\Controller\\JsonApiSchema\\'.$className.'Schema',$canonicalNameResponse);

        return [$canonicalNameResponse => $canonicalNameSchema];
    }

    private function urlPrefix(): string
    {
        $request = $this->requestStack->getCurrentRequest();
        $uriArray = explode('/', $request->getUri());
        $count = count($uriArray) - 1;

        if (Identifier::is($uriArray[$count])) {
            array_pop($uriArray);
        }

        array_pop($uriArray);
        $uriPrefix = implode('/', $uriArray);

        /**if ($this->environment !== 'dev') {
        $uriPrefix = str_replace("http:", "https:", $uriPrefix);
        }**/

        return $uriPrefix;
    }

    private function data(ResponseInterface $response): array|ResponseInterface
    {
        if ($response instanceof AggregateRootsResponse) {
            return $response->items();
        }

        return $response;
    }

    /**public function encodeError(array $response)
    {
        $exception = $response['exception'];
        $code = $exception->getCode();
        $text = $this->translator->trans($exception->text(), $exception->parameters());
        $title = $text;
        $details = $text;

        $result = Encoder::instance()
            ->encodeError(new Error(null, null, null, null, $code, $title, $details));

        return $result;
    }**/


}