<?php

namespace ProjectPageBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectPageControllerTest extends WebTestCase
{
    public function testDisplayProject()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/project/test');

        $this->assertContains('Page projet', $client->getResponse()->getContent());
    }
}
