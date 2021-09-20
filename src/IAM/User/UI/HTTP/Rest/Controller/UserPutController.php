<?php

namespace App\IAM\User\UI\HTTP\Rest\Controller;

use App\IAM\User\Application\Command\SignUp\SignUpUserCommand;
use App\Shared\UI\HTTP\Rest\Controller\ApiRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class UserPutController extends ApiRestController
{
    public function __invoke(Request $request): JsonResponse
    {
        $command = new SignUpUserCommand(
            $request->request->get('id'),
            $request->request->get('email'),
            $request->request->get('password'),
            $request->request->get('first_name'),
            $request->request->get('last_name'),
            $request->request->get('phone'),
            $request->request->get('roles')
        );
        $this->dispatch($command);

        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }
}