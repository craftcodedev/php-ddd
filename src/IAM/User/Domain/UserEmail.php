<?php


namespace App\IAM\User\Domain;


use App\Shared\Domain\Email;

final class UserEmail extends Email
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}