<?php

namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MailerTest extends WebTestCase
{
    use MailerAssertionsTrait;

    public function testMailIsSent()
    {
        $client = $this->createClient();
        $client->request('GET', '/email/send');

        $this->assertResponseIsSuccessful();
        $this->assertEmailCount(1);
    }
}