<?php


namespace App\Tests\IAM\Token\Application\Command\Create;


use App\IAM\Token\Application\Command\Create\CreateTokenCommandHandler;
use App\IAM\Token\Application\Command\Create\CreateTokenUseCase;
use App\IAM\Token\Domain\Event\TokenCreatedDomainEvent;
use App\IAM\Token\Domain\Token;
use App\IAM\Token\Domain\TokenRepositoryInterface;
use App\IAM\Token\Infrastructure\Service\Token\TokenAdapter;
use App\Shared\Domain\Bus\Event\EventProvider;
use App\Shared\Domain\Security\Authentication\JWTEncoderInterface;
use App\Tests\Shared\Domain\Security\Authentication\PayloadStub;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_token
 * @group iam_token_application
 * @group iam_token_application_command
 * @group unit_test
 */
final class CreateTokenFlowTest extends MockeryTestCase
{
    /** @test */
    public function it_should_create_token(): void
    {
        $command = CreateTokenCommandStub::byDefault();
        $tokenAdapterStub = $this->createTokenAdapterStub();
        $jwtEncoderStub = $this->createJWTEncoderStub();
        $repositoryMock = $this->createUserRepositoryMock();
        $eventProvider = new EventProvider();
        $useCase = new CreateTokenUseCase($repositoryMock, $eventProvider);
        $handler = new CreateTokenCommandHandler($tokenAdapterStub, $jwtEncoderStub, $useCase);

        $handler->handle($command);

        $domainEvents = $eventProvider->release();
        $this->assertCount(1, $domainEvents);
        $this->assertInstanceOf(TokenCreatedDomainEvent::class, $domainEvents[0]);
    }

    private function createTokenAdapterStub(): TokenAdapter
    {
        $mock = \Mockery::mock(TokenAdapter::class);

        $mock->shouldReceive('findPayloadFromEmailAndPasswordAndRole')
            ->andReturn(PayloadStub::byDefault());

        return $mock;
    }

    private function createJWTEncoderStub(): JWTEncoderInterface
    {
        $mock = \Mockery::mock(JWTEncoderInterface::class);

        $mock->shouldReceive('encode')->andReturn("hash");

        return $mock;
    }

    private function createUserRepositoryMock(): TokenRepositoryInterface
    {
        $mock = \Mockery::mock(TokenRepositoryInterface::class);

        $mock->shouldReceive('add')->once()->with(Token::class)->andReturnNull();

        return $mock;
    }
}