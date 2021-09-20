<?php


namespace App\IAM\User\Domain;


use App\Shared\Domain\Criteria\Criteria;

interface UserRepositoryInterface
{
    public function add(User $user): void;
    public function get(UserId $userId): ?User;
    public function findByCriteria(Criteria $criteria): array;
    public function remove(User $user): void;
}