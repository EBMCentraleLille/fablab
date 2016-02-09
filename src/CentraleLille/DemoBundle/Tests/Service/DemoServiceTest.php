<?php
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
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
=======

>>>>>>> Fix
namespace CentraleLille\DemoBundle\Tests\Service;

use CentraleLille\DemoBundle\Service\DemoService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
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
=======
class DefaultControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * TestGetUser : Check the return of the function getUser
>>>>>>> Fix
     */
    public function testGetUser()
    {
        //mock the anonymous token
        $anonymousMock = $this->getMockBuilder('Symfony\Component\Security\Core\Authentication\Token\AnonymousToken')
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
            ->disableOriginalConstructor()->getMock();
=======
                ->disableOriginalConstructor()->getMock();
>>>>>>> Fix
        $anonymousMock->method('getUser')->will($this->returnValue(false));

        //mock the token Storage
        $mock = $this->getMock('Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage');
        $mock->expects($this->once())->method('getToken')->will($this->returnValue($anonymousMock));

        $demoService = new DemoService($mock);
        $demoService->getUser();
    }

<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
    /**
     * Test Set Role
     *
     * Description function
     *
     * @return something
     */
=======
>>>>>>> Fix
    public function testSetRole()
    {
    }
}
