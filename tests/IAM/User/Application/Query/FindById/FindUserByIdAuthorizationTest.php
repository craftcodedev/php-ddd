<?php


namespace App\Tests\IAM\User\Application\Query\FindById;


use App\IAM\User\Application\Query\FindById\FindUserByIdAuthorization;
use App\Shared\Domain\Security\Authentication\AuthUser;
use App\Shared\Domain\Security\Authentication\AuthUserRepositoryInterface;
use App\Shared\Domain\Security\Authorization\UnauthorizedUserException;
use App\Tests\IAM\User\Domain\UserStub;
use App\Tests\Shared\Domain\Security\Authentication\AuthUserStub;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_application
 * @group iam_user_application_query
 * @group unit_test
 */
final class FindUserByIdAuthorizationTest extends MockeryTestCase
{
    /** @test */
    public function it_should_throw_unauthorized_user_exception(): void
    {
        $user = UserStub::byDefault();
        $authUser = AuthUserStub::fromValues(
            '1',
            $user->email()->value(),
            $user->firstName()->value(),
            $user->lastName()->value(),
            explode(',', $user->roles()->value())
        );
        $query = FindUserByIdQueryStub::byDefault();
        $repository = $this->createAuthUserRepositoryStub($authUser);
        $authorization = new FindUserByIdAuthorization($repository);
        $this->expectException(UnauthorizedUserException::class);
        $this->expectExceptionMessage(UnauthorizedUserException::fromId($query->id())->getMessage());

        $authorization->authorize($query);
    }

    /** @test */
    public function it_should_authorize(): void
    {
        $user = UserStub::byDefault();
        $authUser = AuthUserStub::fromValues(
            $user->id()->value(),
            $user->email()->value(),
            $user->firstName()->value(),
            $user->lastName()->value(),
            explode(',', $user->roles()->value())
        );
        $query = FindUserByIdQueryStub::byDefault();
        $repository = $this->createAuthUserRepositoryStub($authUser);
        $authorization = new FindUserByIdAuthorization($repository);

        $authorization->authorize($query);
    }

    private function createAuthUserRepositoryStub(AuthUser $authUser): AuthUserRepositoryInterface
    {
        $mock = \Mockery::mock(AuthUserRepositoryInterface::class);
        $mock->shouldReceive('get')->andReturn($authUser);

        return $mock;
    }
}