<?php


namespace App\IAM\Token\Domain;


use App\Shared\Domain\DateValueObject;

final class TokenCreatedAt extends DateValueObject
{
    public function __construct(\DateTime $value)
    {
        $this->value = $value;
    }
}