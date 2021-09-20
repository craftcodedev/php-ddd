<?php


namespace App\IAM\User\Domain;


use App\Shared\Domain\DateValueObject;

final class UserUpdatedAt extends DateValueObject
{
    public function __construct(\DateTime $value)
    {
        $this->value = $value;
    }
}