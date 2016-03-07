<?php

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
class TaskControllerTest extends WebTestCase
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

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Task list', $client->getResponse()->getContent());
    }
}
