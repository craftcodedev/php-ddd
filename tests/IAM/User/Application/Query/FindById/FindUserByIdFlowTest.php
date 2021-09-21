<?php


namespace App\Tests\IAM\User\Application\Query\FindById;


use App\IAM\User\Application\Query\FindById\FindUserByIdQueryHandler;
use App\IAM\User\Application\Query\FindById\FindUserByIdUseCase;
use App\IAM\User\Application\Query\Response\UserResponseConverter;
use App\IAM\User\Domain\Service\UserFinder;
use App\IAM\User\Domain\User;
use App\IAM\User\Domain\UserRepositoryInterface;
use App\Shared\Domain\Helper\Reflection;
use App\Tests\IAM\User\Domain\UserStub;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_application
 * @group iam_user_application_query
 * @group unit_test
 */
final class FindUserByIdFlowTest extends MockeryTestCase
{
    /** @test */
    public function it_should_find_user_by_id(): void
    {
        $user = UserStub::byDefault();
        $query = FindUserByIdQueryStub::byDefault();
        $finder = $this->createUserFinder($user);
        $userResponseConverter = new UserResponseConverter();
        $useCase = new FindUserByIdUseCase($finder, $userResponseConverter);
        $handler = new FindUserByIdQueryHandler($useCase);

        $userResponse = $handler->handle($query);

        $this->assertEquals($user->id()->value(), $userResponse->id());
        $this->assertEquals($user->email()->value(), $userResponse->email());
        $this->assertEquals($user->firstName()->value(), $userResponse->firstName());
        $this->assertEquals($user->lastName()->value(), $userResponse->lastName());
        $this->assertEquals($user->phone()->value(), $userResponse->phone());
        $this->assertEquals($user->roles()->value(), $userResponse->roles());
        $this->assertEquals($user->status()->value(), $userResponse->status());
        $this->assertEquals($user->createdAt()->toString(), $userResponse->createdAt());
        $this->assertEquals($user->updatedAt()->toString(), $userResponse->updatedAt());
        $this->assertEquals(9, Reflection::CountObjectProperties($userResponse));
    }

    private function createUserFinder(User $user): UserFinder
    {
        $mock = \Mockery::mock(UserRepositoryInterface::class);
        $mock->shouldReceive('get')->andReturn($user);

        return new UserFinder($mock);
    }
}