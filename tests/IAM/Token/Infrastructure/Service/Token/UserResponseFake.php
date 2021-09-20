<?php


namespace App\Tests\IAM\Token\Infrastructure\Service\Token;


use App\Shared\Domain\Bus\Query\Response\ResponseInterface;

final class UserResponseFake implements ResponseInterface
{
    public function __construct(
        private string $id,
        private string $email,
        private string $firstName,
        private string $lastName,
        private string $phone,
        private string $roles,
        private string $status,
        private string $createdAt,
        private string $updatedAt
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function firstName() : string
    {
        return $this->firstName;
    }

    public function lastName() : string
    {
        return $this->lastName;
    }

    public function phone() : string
    {
        return $this->phone;
    }

    public function roles(): string
    {
        return $this->roles;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function updatedAt(): string
    {
        return $this->updatedAt;
    }
}