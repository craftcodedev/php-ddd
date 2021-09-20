<?php


namespace App\Tests\IAM\Token\Application\Event;


use App\IAM\Token\Application\Event\SetTokenToHeaderWhenTokenCreatedHandler;
use App\Tests\Shared\Domain\Bus\Event\DomainEventFake;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @group iam
 * @group iam_token
 * @group iam_token_application
 * @group iam_token_application_event
 * @group unit_test
 */
final class SetTokenToHeaderWhenTokenCreatedHandlerTest extends MockeryTestCase
{
    /** @test */
    public function it_should_subscribe_to(): void
    {
        $requestStackDummy = \Mockery::mock(RequestStack::class);
        $sendWelcomeEmailWhenUserSignedUp = new SetTokenToHeaderWhenTokenCreatedHandler($requestStackDummy);

        $event = $sendWelcomeEmailWhenUserSignedUp->subscribeTo();

        $this->assertEquals('token_created', $event['name']);
        $this->assertEquals('sync', $event['type']);
        $this->assertEquals(1, $event['order']);
    }

    /** @test */
    public function it_should_handle_successful_event(): void
    {
        [$requestStack, $request] = $this->createRequests();
        $sendWelcomeEmailWhenUserSignedUp = new SetTokenToHeaderWhenTokenCreatedHandler($requestStack);
        $body = ["hash" => "hash1"];
        $domainEvent = new DomainEventFake("1", $body);

        $sendWelcomeEmailWhenUserSignedUp->handle($domainEvent);

        $this->assertEquals($request->headers->data(), ['Authorization' => $body['hash']]);
    }

    private function createRequests(): array
    {
        $request = \Mockery::mock(Request::class);
        $request->headers = new Class() {
            private array $data;

            public function add(array $data): void {
                $this->data = $data;
            }

            public  function data(): array {
                return $this->data;
            }
        };
        $requestStack = \Mockery::mock(RequestStack::class);

        $requestStack->shouldReceive('getCurrentRequest')->andReturn($request);

        return [$requestStack, $request];
    }
}