<?php


namespace App\Tests\IAM\User\Domain;


use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\Security\Authentication\AuthUser;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_domain
 * @group unit_test
 */
final class UserRolesTest extends MockeryTestCase
{
    /** @test */
    public function it_should_require_a_valid_role(): void
    {
        $value = 'roles';
        $this->expectException(InvalidAttributeException::class);
        $this->expectExceptionMessage(InvalidAttributeException::fromValue('roles', $value)->getMessage());

        UserRolesStub::fromValue($value);
    }

    /** @test */
    public function it_should_throw_invalid_student_exception(): void
    {
        $values = implode(',', AuthUser::ROLES);
        $this->expectException(InvalidAttributeException::class);
        $this->expectExceptionMessage(InvalidAttributeException::fromText('student user can have only one role')->getMessage());

        UserRolesStub::fromValue($values);;
    }
}