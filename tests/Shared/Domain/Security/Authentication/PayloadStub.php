<?php


namespace App\Tests\Shared\Domain\Security\Authentication;


use App\Shared\Domain\Security\Authentication\Payload;

final class PayloadStub
{
    public static function byDefault(): Payload
    {
        $authUser = AuthUserStub::byDefault();
        $phone = '1';
        $status = '1';
        $createdAt = 'createdAt';
        $updatedAt = 'updatedAt';

        return Payload::fromValues(
            $authUser->id(),
            $authUser->email(),
            $authUser->firstName(),
            $authUser->lastName(),
            $phone,
            implode(',', $authUser->roles()),
            $status,
            $createdAt,
            $updatedAt,
        );
    }
}