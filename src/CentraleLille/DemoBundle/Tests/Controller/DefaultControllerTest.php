<?php
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
/**
 * CentraleLilleDemoBundle File Doc Comment
 *
 * PHP Version 5.5
 *
 * @category DefaultControllerTest
 * @package  DefaultControllerTest
 * @author   Display Name <ml.94230@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
=======
>>>>>>> Fix

namespace CentraleLille\DemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
/**
 * CentraleLilleDemoBundle Class Doc Comment
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
=======
class DefaultControllerTest extends WebTestCase
{
>>>>>>> Fix
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
