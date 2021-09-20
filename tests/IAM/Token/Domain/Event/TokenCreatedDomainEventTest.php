<?php


namespace App\Tests\IAM\Token\Domain\Event;


use App\IAM\Token\Domain\Event\TokenCreatedDomainEvent;
use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\InvalidDomainEventException;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_token
 * @group iam_token_domain
 * @group iam_token_domain_event
 * @group unit_test
 */
final class TokenCreatedDomainEventTest extends MockeryTestCase
{
    /**
     * @test
     * @dataProvider data
     */
    public function it_should_throw_invalid_domain_event_exception_from_attribute(string $bodyAttribute, array $body): void
    {
        $this->expectException(InvalidDomainEventException::class);
        $this->expectExceptionMessage(InvalidDomainEventException::fromBody(
            TokenCreatedDomainEvent::NAME,
            $bodyAttribute
        )->getMessage());

        $this->createDomainEvent($body);
    }

    /** @test */
    public function it_should_set_body(): void
    {
        $body = ['hash' => 'hash', 'user_id' => 'user_id', 'created_at' => 'created_at', 'updated_at' => 'updated_at'];

        $domainEvent = $this->createDomainEvent($body);

        $this->assertEquals("hash", $domainEvent->body()['hash']);
        $this->assertCount(4, $domainEvent->body());
    }

    public function data(): array
    {
        return [
            ['hash', []],
            ['user_id', ['hash' => 'hash']],
            ['created_at', ['hash' => 'hash', 'user_id' => 'user_id']],
            ['updated_at', ['hash' => 'hash', 'user_id' => 'user_id', 'created_at' => 'created_at']],
        ];
    }

    private function createDomainEvent(array $body): DomainEvent
    {
        return new TokenCreatedDomainEvent("1", $body);
    }
}
