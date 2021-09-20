<?php


namespace App\Tests\IAM\User\Domain\Event;


use App\IAM\User\Domain\Event\UserSignedUpDomainEvent;
use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\InvalidDomainEventException;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_domain
 * @group iam_user_domain_event
 * @group unit_test
 */
final class UserSignedUpDomainEventTest extends MockeryTestCase
{
    /**
     * @test
     * @dataProvider data
     */
    public function it_should_throw_invalid_domain_event_exception_from_attribute(string $bodyAttribute, array $body): void
    {
        $this->expectException(InvalidDomainEventException::class);
        $this->expectExceptionMessage(InvalidDomainEventException::fromBody(
            UserSignedUpDomainEvent::NAME,
            $bodyAttribute
        )->getMessage());

        $this->createDomainEvent($body);
    }

    /** @test */
    public function it_should_set_body(): void
    {
        $body = [
            'email' => 'email',
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'phone' => 'phone',
            'roles' => 'roles',
            'status' => 'status',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at'
        ];

        $domainEvent = $this->createDomainEvent($body);

        $this->assertEquals("email", $domainEvent->body()['email']);
        $this->assertCount(8, $domainEvent->body());
    }

    public function data(): array
    {
        return [
            ['email', []],
            ['first_name', ['email' => 'email']],
            ['last_name', ['email' => 'email', 'first_name' => 'first_name']],
            ['phone', ['email' => 'email', 'first_name' => 'first_name', 'last_name' => 'last_name']],
            ['roles', ['email' => 'email', 'first_name' => 'first_name', 'last_name' => 'last_name', 'phone' => 'phone']],
            ['status', ['email' => 'email', 'first_name' => 'first_name', 'last_name' => 'last_name', 'phone' => 'phone', 'roles' => 'roles']],
            ['created_at', ['email' => 'email', 'first_name' => 'first_name', 'last_name' => 'last_name', 'phone' => 'phone', 'roles' => 'roles', 'status' => 'status']],
            ['updated_at', ['email' => 'email', 'first_name' => 'first_name', 'last_name' => 'last_name', 'phone' => 'phone', 'roles' => 'roles', 'status' => 'status', 'created_at' => 'created_at']],
        ];
    }
    
    private function createDomainEvent(array $body): DomainEvent
    {
        return new UserSignedUpDomainEvent("1", $body);
    }
}
