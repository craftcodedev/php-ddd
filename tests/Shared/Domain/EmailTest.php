<?php


namespace App\Tests\Shared\Domain;


use App\IAM\User\Domain\UserEmail;
use App\Shared\Domain\Exception\InvalidAttributeException;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group shared
 * @group shared_domain
 * @group unit_test
 */
final class EmailTest extends MockeryTestCase
{
    /** @test */
    public function it_should_require_a_valid_email(): void
    {
        $value = 'UserEmail';
        $this->expectException(InvalidAttributeException::class);
        $this->expectExceptionMessage(InvalidAttributeException::fromValue('email', $value)->getMessage());

        EmailStub::fromValue($value);
    }

    /** @test */
    public function it_should_require_a_email_with_no_max_of_60_chars(): void
    {
        $value = 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttest@email.com';
        $this->expectException(InvalidAttributeException::class);
        $this->expectExceptionMessage(InvalidAttributeException::fromMaxLength('email', UserEmail::MAX_LENGTH)->getMessage());

        EmailStub::fromValue($value);
    }
}