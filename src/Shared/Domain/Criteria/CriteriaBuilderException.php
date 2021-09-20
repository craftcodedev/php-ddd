<?php

namespace App\Shared\Domain\Criteria;

use App\Shared\Domain\Exception\ErrorException;

class CriteriaBuilderException extends ErrorException
{
    public static function fromWhere(): self
    {
        return new static('where method cannot be called twice.', []);
    }
}
