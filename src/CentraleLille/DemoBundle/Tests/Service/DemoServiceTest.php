<?php
class DefaultControllerTest extends \PHPUnit_Framework_TestCase

namespace CentraleLille\DemoBundle\Tests\Service;

use CentraleLille\DemoBundle\Service\DemoService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

{
    /**
     * TestGetUser : Check the return of the function getUser
     */
    public function testGetUser()
    {
        //mock the anonymous token
        $anonymousMock = $this->getMockBuilder('Symfony\Component\Security\Core\Authentication\Token\AnonymousToken')
                ->disableOriginalConstructor()->getMock();
        $anonymousMock->method('getUser')->will($this->returnValue(false));

        //mock the token Storage
        $mock = $this->getMock('Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage');
        $mock->expects($this->once())->method('getToken')->will($this->returnValue($anonymousMock));

        $demoService = new DemoService($mock);
        $demoService->getUser();
    }

    public function testSetRole()
    {
    }
}
