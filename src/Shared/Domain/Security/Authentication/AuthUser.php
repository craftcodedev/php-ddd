<?php


namespace App\Shared\Domain\Security\Authentication;


final class AuthUser
{
    const ROLE_STUDENT = 'ROLE_STUDENT';
    const ROLE_TEACHER = 'ROLE_TEACHER';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    const ROLES = [
        AuthUser::ROLE_STUDENT,
        AuthUser::ROLE_TEACHER,
        AuthUser::ROLE_ADMIN,
    ];

    private function __construct(
        private string $id,
        private string $email,
        private string $firstName,
        private string $lastName,
        private array $roles
    ) {
    }

    public static function fromValues(
        string $id,
        string $email,
        string $firstName,
        string $lastName,
        array $roles
    ): self {
        return new self($id, $email, $firstName, $lastName, $roles);
    }

    public function id(): string
    {
        return $this->id;
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

    public function roles(): array
    {
        return $this->roles;
    }

    public function isStudent(): bool
    {
        return in_array(self::ROLE_STUDENT, $this->roles);
    }

    public function isTeacher(): bool
    {
        return in_array(self::ROLE_TEACHER, $this->roles);
    }

    public function isAdmin(): bool
    {
        return in_array(self::ROLE_ADMIN, $this->roles);
    }

    public static function contains(string $role): bool
    {
        if (in_array($role, self::ROLES)) {
            return true;
        }

        return false;
    }
}