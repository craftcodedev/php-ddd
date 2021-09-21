<?php

namespace App\IAM\User\UI\HTTP\Rest\Controller;

use App\IAM\User\Application\Query\FindByCriteria\FindUsersByCriteriaQuery;
use App\Shared\Infrastructure\Bus\Query\Criteria\JsonApiCriteriaValueFactory;
use App\Shared\UI\HTTP\Rest\Controller\ApiRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class UsersGetController extends ApiRestController
{
    public function __invoke(Request $request): JsonResponse
    {
        $factory = new JsonApiCriteriaValueFactory($request->query->all());
        $query = new FindUsersByCriteriaQuery($factory);

        return $this->ask($query);
    }
}