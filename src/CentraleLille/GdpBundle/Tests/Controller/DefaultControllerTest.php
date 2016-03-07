<?php
/**
 * DefaultControllerTest File Doc Comment
 *
 * PHP Version 5.5
 *
 * @category DefaultControllerTest
 * @package  DefaultControllerTest
 * @author   Display Name <ml.94230@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
namespace CentraleLille\GdpBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * DefaultControllerTest Class Doc Comment
 *
 * @category DefaultControllerTest
 * @package  DefaultControllerTest
 * @author   Display Name <ml.94230@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * Test Index
     *
     * Description function
     *
     * @return something
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
