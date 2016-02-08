<?php

namespace CentraleLille\GdpBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/gdp/tasks');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Task list', $client->getResponse()->getContent());
    }
}
