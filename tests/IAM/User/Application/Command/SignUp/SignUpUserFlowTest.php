<?php


namespace App\Tests\IAM\User\Application\Command\SignUp;


use App\IAM\User\Application\Command\SignUp\SignUpUserCommandHandler;
use App\IAM\User\Application\Command\SignUp\SignUpUserUseCase;
use App\IAM\User\Domain\Event\UserSignedUpDomainEvent;
use App\IAM\User\Domain\User;
use App\IAM\User\Domain\UserRepositoryInterface;
use App\Shared\Domain\Bus\Event\EventProvider;
use App\Shared\Domain\HashedPassword;
use App\Shared\Infrastructure\Service\Hashing\HashingInterface;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_application
 * @group iam_user_application_command
 * @group unit_test
 */
final class SignUpUserFlowTest extends MockeryTestCase
{
    /** @test */
    public function it_should_sign_up_user(): void
    {
        $command = SignUpUserCommandStub::byDefault();
        $userRepositoryMock = $this->createUserRepositoryMock();
        $hashingStub = $this->createHashingStub();
        $eventProvider = new EventProvider();
        $useCase = new SignUpUserUseCase($userRepositoryMock, $eventProvider);
        $handler = new SignUpUserCommandHandler($hashingStub, $useCase);

        $handler->handle($command);

        $domainEvents = $eventProvider->release();
        $this->assertCount(1, $domainEvents);
        $this->assertInstanceOf(UserSignedUpDomainEvent::class, $domainEvents[0]);
    }

    private function createUserRepositoryMock(): UserRepositoryInterface
    {
        $mock = \Mockery::mock(UserRepositoryInterface::class);

        $mock->shouldReceive('add')->once()->with(User::class)->andReturnNull();

        return $mock;
    }

    private function createHashingStub(): HashingInterface
    {
        $mock = \Mockery::mock(HashingInterface::class);

        $mock->shouldReceive('hash')->andReturn(HashedPassword::fromString("password"));

        return $mock;
    }
}