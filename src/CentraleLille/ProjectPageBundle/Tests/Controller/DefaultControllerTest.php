<?php

namespace ProjectPageBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectPageControllerTest extends WebTestCase
{
    public function testDisplayProject()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Page Projet', $client->getResponse()->getContent());
    }
}
