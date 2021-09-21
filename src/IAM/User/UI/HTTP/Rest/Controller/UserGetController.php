<?php

namespace App\IAM\User\UI\HTTP\Rest\Controller;

use App\IAM\User\Application\Query\FindById\FindUserByIdQuery;
use App\Shared\UI\HTTP\Rest\Controller\ApiRestController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class UserGetController extends ApiRestController
{
    public function __invoke(string $id): JsonResponse
    {
        $query = new FindUserByIdQuery($id);

        return $this->ask($query);
    }
}