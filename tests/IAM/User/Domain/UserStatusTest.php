<?php


namespace App\Tests\IAM\User\Domain;


use App\Shared\Domain\Exception\InvalidAttributeException;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_domain
 * @group unit_test
 */
final class UserStatusTest extends MockeryTestCase
{
    /** @test */
    public function it_should_require_a_valid_status(): void
    {
        $value = '12345678901234567890123456789021234567891';
        $this->expectException(InvalidAttributeException::class);
        $this->expectExceptionMessage(InvalidAttributeException::fromValue('status', $value)->getMessage());

        UserStatusStub::fromValue($value);
    }
}