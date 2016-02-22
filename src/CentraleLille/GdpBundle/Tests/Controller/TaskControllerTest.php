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

    public function testTask()
    {
        $client = static::createClient();

    }

    public function testRest()
    {
        // create entity manager mock
        $entityManagerMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(array('persist', 'flush'))
            ->disableOriginalConstructor()
            ->getMock();

        // now you can get some assertions if you want, eg.:
        $entityManagerMock->expects($this->once())->method('flush');

        // next you need inject your mocked em into client's service container
        $client = static::createClient();
        $client->getContainer()->set('doctrine.orm.default_entity_manager', $entityManagerMock);

        // then you just do testing as usual
        $crawler = $client->request('POST', '/service/sandbox', array(), array(), array(), json_encode(array('name' => 'TestMe', 'description' => 'TestDesc')));

        $this->assertEquals(
            201, $client->getResponse()->getStatusCode()
        );
    }
}
