<?php


namespace App\IAM\User\Application\Query\FindById;


use App\Shared\Domain\Bus\Query\QueryInterface;

final class FindUserByIdQuery implements QueryInterface
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}