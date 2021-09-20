<?php


namespace App\Tests\IAM\User\Domain\Service;


use App\IAM\User\Domain\Service\Exception\UserNotFoundException;
use App\IAM\User\Domain\Service\UserFinder;
use App\IAM\User\Domain\UserId;
use App\IAM\User\Domain\UserRepositoryInterface;
use App\Shared\Domain\Criteria\Criteria;
use App\Tests\IAM\User\Domain\UserPasswordStub;
use App\Tests\IAM\User\Domain\UserStub;
use App\Tests\Shared\Domain\Criteria\CriteriaStub;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_domain
 * @group iam_user_domain_service
 * @group unit_test
 */
final class UserFinderTest extends MockeryTestCase
{
    /** @test */
    public function it_should_throw_user_not_found_exception_by_id(): void
    {
        $user = UserStub::byDefault();
        $repository = $this->createUserRepositoryMock(null);
        $userFinder = $this->createUserFinder($repository);
        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage(UserNotFoundException::fromId($user->id()->value())->getMessage());

        $userFinder->findById($user->id());
    }

    /** @test */
    public function it_should_throw_user_not_found_exception_by_criteria(): void
    {
        $password = UserPasswordStub::byDefault();
        $criteria = CriteriaStub::byDefault();
        $repository = $this->createUserRepositoryMock([]);
        $userFinder = $this->createUserFinder($repository);
        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage(UserNotFoundException::default()->getMessage());

        $userFinder->findByCriteriaAndPassword($criteria, $password);
    }

    /** @test */
    public function it_should_throw_wrong_password_exception_by_criteria(): void
    {
        $userExpected = UserStub::byDefault();
        $password = UserPasswordStub::fromValue("password");
        $criteria = CriteriaStub::byDefault();
        $repository = $this->createUserRepositoryMock([$userExpected]);
        $userFinder = $this->createUserFinder($repository);
        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage(UserNotFoundException::fromPassword()->getMessage());

        $userFinder->findByCriteriaAndPassword($criteria, $password);
    }

    private function createUserRepositoryMock($return): UserRepositoryInterface
    {
        $mock = \Mockery::mock(UserRepositoryInterface::class);
        $testName = $this->getName();

        match ($testName) {
            'it_should_throw_user_not_found_exception_by_id',
                => $mock->shouldReceive('get')->once()->with(UserId::class)->andReturn($return),
            'it_should_throw_user_not_found_exception_by_criteria',
            'it_should_throw_wrong_password_exception_by_criteria',
                => $mock->shouldReceive('findByCriteria')->once()->with(Criteria::class)->andReturn($return)
        };

        return $mock;
    }

    private function createUserFinder(UserRepositoryInterface $repository): UserFinder
    {
        return new UserFinder($repository);
    }
}