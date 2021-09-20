<?php


namespace App\Tests\IAM\Token\Infrastructure\Service\Token;


use App\IAM\Token\Infrastructure\Service\Token\TokenAdapter;
use App\IAM\Token\Infrastructure\Service\Token\TokenFacade;
use App\IAM\User\Application\Query\FindByEmailAndPasswordAndRoles\FindUserByEmailAndPasswordAndRolesQuery;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\Shared\Domain\Bus\Query\Response\ResponseInterface;
use App\Shared\Domain\Helper\Reflection;
use App\Tests\Shared\Domain\Security\Authentication\PayloadStub;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_token
 * @group iam_token_infrastructure
 * @group iam_token_infrastructure_service
 * @group iam_token_infrastructure_service_token
 * @group unit_test
 */
final class TokenFlowTest extends MockeryTestCase
{
    /** @test */
    public function it_should_find_payload(): void
    {
        $payloadStub = PayloadStub::byDefault();
        $response = new UserResponseFake(
            $payloadStub->userId(),
            $payloadStub->email(),
            $payloadStub->firstName(),
            $payloadStub->lastName(),
            $payloadStub->phone(),
            $payloadStub->roles(),
            $payloadStub->status(),
            $payloadStub->createdAt(),
            $payloadStub->updatedAt(),
        );
        $password = '12345678';
        $queryBusMock = $this->createQueryBusMock($response);
        $facade = new TokenFacade($queryBusMock);
        $tokenAdapter = new TokenAdapter($facade);

        $payload = $tokenAdapter->findPayloadFromEmailAndPasswordAndRole($response->email(), $password, $response->roles());

        $this->assertEquals($response->id(), $payload->userId());
        $this->assertEquals($response->email(), $payload->email());
        $this->assertEquals($response->firstName(), $payload->firstName());
        $this->assertEquals($response->lastName(), $payload->lastName());
        $this->assertEquals($response->phone(), $payload->phone());
        $this->assertEquals($response->roles(), $payload->roles());
        $this->assertEquals($response->status(), $payload->status());
        $this->assertEquals($response->createdAt(), $payload->createdAt());
        $this->assertEquals($response->updatedAt(), $payload->updatedAt());
        $this->assertEquals(9, Reflection::CountObjectProperties($payload));
    }

    private function createQueryBusMock(ResponseInterface $response): QueryBusInterface
    {
        $mock = \Mockery::mock(QueryBusInterface::class);

        $mock->shouldReceive('ask')
            ->once()
            ->with(FindUserByEmailAndPasswordAndRolesQuery::class)
            ->andReturn($response);

        return $mock;
    }
}