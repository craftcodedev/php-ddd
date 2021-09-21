<?php


namespace App\Tests\IAM\User\Application\Query\FindByCriteria;


use App\IAM\User\Application\Query\FindByCriteria\FindUsersByCriteriaQueryHandler;
use App\IAM\User\Application\Query\FindByCriteria\FindUsersByCriteriaUseCase;
use App\IAM\User\Application\Query\Response\UserResponse;
use App\IAM\User\Application\Query\Response\UsersResponseConverter;
use App\IAM\User\Domain\User;
use App\IAM\User\Domain\UserRepositoryInterface;
use App\Shared\Domain\Criteria\Criteria;
use App\Tests\IAM\User\Domain\UserStub;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_application
 * @group iam_user_application_query
 * @group unit_test
 */
final class FindUsersByCriteriaFlowTest extends MockeryTestCase
{
    /** @test */
    public function it_should_find_one_user_by_criteria(): void
    {
        $user = UserStub::byDefault();
        $query = FindUsersByCriteriaQueryStub::byDefault();
        $userRepositoryMock = $this->createUserRepositoryInterfaceMock($user);
        $userResponseConverter = new UsersResponseConverter();
        $useCase = new FindUsersByCriteriaUseCase($userRepositoryMock, $userResponseConverter);
        $handler = new FindUsersByCriteriaQueryHandler($useCase);

        $usersResponse = $handler->handle($query);

        $this->assertCount(1, $usersResponse->items());
        $this->assertInstanceOf(UserResponse::class, $usersResponse->items()[0]);
    }

    private function createUserRepositoryInterfaceMock(User $user): UserRepositoryInterface
    {
        $mock = \Mockery::mock(UserRepositoryInterface::class);

        $mock->shouldReceive('findByCriteria')->once()->with(Criteria::class)->andReturn([$user]);

        return $mock;
    }
}