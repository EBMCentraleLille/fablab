<?php

namespace CentraleLille\DemoBundle\Tests\Service;

use CentraleLille\DemoBundle\Service\DemoService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * TestGetUser : Check the return of the function getUser
     */
    public function testGetUser()
    {
        $anonymousMock = $this->getMockBuilder('Symfony\Component\Security\Core\Authentication\Token\AnonymousToken')
                ->disableOriginalConstructor()->getMock();
        $anonymousMock->method('getUser')->will($this->returnValue(false));
        $mock = $this->getMock('Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage');
        $mock->expects($this->once())->method('getToken')->will($this->returnValue($anonymousMock));
        $demoService = new DemoService($mock);
    }

    public function testSetRole()
    {
    }
}
