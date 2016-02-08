<?php

namespace CentraleLille\GdpBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/gdp');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Hello GDP !', $client->getResponse()->getContent());
    }
}
