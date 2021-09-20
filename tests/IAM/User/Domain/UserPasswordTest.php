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
final class UserPasswordTest extends MockeryTestCase
{
    /**
     * @test
     * @dataProvider data
     */
    public function it_should_throw_an_invalid_attribute_exception(string $value): void
    {
        $this->expectException(InvalidAttributeException::class);
        $this->expectExceptionMessage(InvalidAttributeException::fromValue('password', $value)->getMessage());

        UserPasswordStub::fromValue($value);
    }

    public function data(): array
    {
        return [
            ['a'],
            ['a1'],
            ['a12'],
            ['a123'],
            ['a1234'],
            ['a12345'],
            ['a123456'],
        ];
    }
}