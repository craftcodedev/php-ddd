<?php


namespace App\Tests\IAM\User\Domain;


use App\IAM\User\Domain\UserPhone;
use App\Shared\Domain\Exception\InvalidAttributeException;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_domain
 * @group unit_test
 */
final class UserPhoneTest extends MockeryTestCase
{
    /** @test */
    public function it_should_require_a_phone_with_no_max_of_30_chars(): void
    {
        $value = '12345678901234567890123456789021234567891';
        $this->expectException(InvalidAttributeException::class);
        $this->expectExceptionMessage(InvalidAttributeException::fromMaxLength('phone', UserPhone::MAX_LENGTH)->getMessage());

        UserPhoneStub::fromValue($value);
    }
}