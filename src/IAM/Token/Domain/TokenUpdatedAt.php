<?php


namespace App\IAM\Token\Domain;


use App\Shared\Domain\DateValueObject;

final class TokenUpdatedAt extends DateValueObject
{
    public function __construct(\DateTime $value)
    {
        $this->value = $value;
    }
}