<?php


namespace App\IAM\User\UI\HTTP\Rest\Controller\JsonApiSchema;


use Neomerx\JsonApi\Contracts\Schema\ContextInterface;
use Neomerx\JsonApi\Schema\BaseSchema;

final class UserResponseSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'users';
    }

    public function getId($resource): ?string
    {
        return $resource->id();
    }

    public function getAttributes($resource, ContextInterface $context): iterable
    {
        return [
            'email' => $resource->email(),
            'firstName' => $resource->firstName(),
            'lastName' => $resource->lastName(),
            'phone' => $resource->phone(),
            'roles' => $resource->roles(),
            'status' => $resource->status(),
            'createdAt' => $resource->createdAt(),
            'updatedAt' => $resource->updatedAt()
        ];
    }

    public function getRelationships($resource, ContextInterface $context): iterable
    {
        return [];
    }
}