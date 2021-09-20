<?php


namespace App\Tests\IAM\User\Application\Event;


use App\IAM\User\Application\Event\SendWelcomeEmailWhenUserSignedUp;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group iam
 * @group iam_user
 * @group iam_user_application
 * @group iam_user_application_event
 * @group unit_test
 */
final class SendWelcomeEmailWhenUserSignedUpTest extends MockeryTestCase
{
    /** @test */
    public function it_should_subscribe_to(): void
    {
        $sendWelcomeEmailWhenUserSignedUp = new SendWelcomeEmailWhenUserSignedUp();

        $event = $sendWelcomeEmailWhenUserSignedUp->subscribeTo();

        $this->assertEquals('user_signed_up', $event['name']);
        $this->assertEquals('sync', $event['type']);
        $this->assertEquals(1, $event['order']);
    }
}