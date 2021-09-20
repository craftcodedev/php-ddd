<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\UserFirstName;
use App\Shared\Domain\Exception\InvalidAttributeException;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_domain
 * @group unit_test
 */
final class UserFirstNameTest extends MockeryTestCase
{
    /** @test */
    public function it_should_throw_invalid_attribute_exception_from_min_length(): void
    {
        $value = 'te';
        $this->expectException(InvalidAttributeException::class);
        $this->expectExceptionMessage(InvalidAttributeException::fromMinLength('first name', UserFirstName::MIN_LENGTH)->getMessage());

        UserFirstNameStub::fromValue($value);
    }

    /** @test */
    public function it_should_throw_invalid_attribute_exception_from_max_length(): void
    {
        $value = 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest';
        $this->expectException(InvalidAttributeException::class);
        $this->expectExceptionMessage(InvalidAttributeException::fromMaxLength('first name', UserFirstName::MAX_LENGTH)->getMessage());

        UserFirstNameStub::fromValue($value);
    }
}