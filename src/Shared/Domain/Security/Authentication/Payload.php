<?php


namespace App\Shared\Domain\Security\Authentication;


final class Payload
{
    private function __construct(
        private string $userId,
        private string $email,
        private string $firstName,
        private string $lastName,
        private string $phone,
        private string $roles,
        private string $status,
        private string $createdAt,
        private string $updatedAt,
    ) {
    }

    public static function fromValues(
        string $userId,
        string $email,
        string $firstName,
        string $lastName,
        string $phone,
        string $roles,
        string $status,
        string $createdAt,
        string $updatedAt
    ): self {
        return new self($userId, $email, $firstName, $lastName, $phone, $roles, $status, $createdAt, $updatedAt);
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function username(): string
    {
        return $this->firstName." ".$this->lastName;
    }

    public function phone(): string
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