<?php


namespace App\Tests\IAM\User\Application\Query\FindByEmailAndPasswordAndRoles;


use App\IAM\User\Application\Query\FindByEmailAndPasswordAndRoles\FindUserByCriteriaAndPasswordUseCase;
use App\IAM\User\Application\Query\FindByEmailAndPasswordAndRoles\FindUserByEmailAndPasswordAndRolesQueryHandler;
use App\IAM\User\Application\Query\Response\UserResponse;
use App\IAM\User\Application\Query\Response\UserResponseConverter;
use App\IAM\User\Domain\Service\UserFinder;
use App\IAM\User\Domain\User;
use App\IAM\User\Domain\UserRepositoryInterface;
use App\Tests\IAM\User\Domain\UserStub;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_application
 * @group iam_user_application_query
 * @group unit_test
 */
final class FindUserByEmailAndPasswordAndRolesFlowTest extends MockeryTestCase
{
    /** @test */
    public function it_should_find_user_by_email_password_and_role(): void
    {
        $user = UserStub::byDefault();
        $query = FindUserByEmailAndPasswordAndRolesQueryStub::byDefault();
        $finder = $this->createUserFinder($user);
        $userResponseConverter = new UserResponseConverter();
        $useCase = new FindUserByCriteriaAndPasswordUseCase($finder, $userResponseConverter);
        $handler = new FindUserByEmailAndPasswordAndRolesQueryHandler($useCase);

        $userResponse = $handler->handle($query);

        $this->assertInstanceOf(UserResponse::class, $userResponse);
    }

    private function createUserFinder(User $user): UserFinder
    {
        $mock = \Mockery::mock(UserRepositoryInterface::class);
        $mock->shouldReceive('findByCriteria')->andReturn([$user]);

        return new UserFinder($mock);
    }
}