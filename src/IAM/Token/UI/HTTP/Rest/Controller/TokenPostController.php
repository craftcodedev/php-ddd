<?php


namespace App\IAM\Token\UI\HTTP\Rest\Controller;


use App\IAM\Token\Application\Command\Create\CreateTokenCommand;
use App\Shared\UI\HTTP\Rest\Controller\ApiRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class TokenPostController extends ApiRestController
{
    public function __invoke(Request $request): JsonResponse
    {
        $command = new CreateTokenCommand(
            $request->request->get('email'),
            $request->request->get('password'),
            $request->request->get('role')
        );
        $this->dispatch($command);

        return new JsonResponse(
            [],
            JsonResponse::HTTP_CREATED,
            ['Authorization' => $request->headers->get('Authorization')]
        );
    }
}