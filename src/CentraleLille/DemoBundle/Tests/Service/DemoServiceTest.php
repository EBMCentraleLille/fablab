<?php
/**
 * DemoServiceTest File Doc Comment
 *
 * PHP Version 5.5
 *
 * @category DemoServiceTest
 * @package  DemoServiceTest
 * @author   Display Name <example@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
namespace CentraleLille\DemoBundle\Tests\Service;

use CentraleLille\DemoBundle\Service\DemoService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * DemoServiceTest Class Doc Comment
 *
 * @category DemoServiceTest
 * @package  DemoServiceTest
 * @author   Display Name <example@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
class DefaultControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test Get User
     *
     * Description function
     *
     * @return something
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

    /**
     * Test Set Role
     *
     * Description function
     *
     * @return something
     */
    public function testSetRole()
    {
    }
}
