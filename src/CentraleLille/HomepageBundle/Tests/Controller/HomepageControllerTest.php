<?php
/**
 * HomePageControllerTest.php File Doc
 *
 * Test de la classe HomePageController
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:HomepageBundle
 * @subpackage Tests
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLilleHomepageBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
/**
 * Test de la classe HomePageController
 *
 * PHP Version 5.6
 *
 * @category   Class
 * @package    CentraleLille:HomepageBundle
 * @subpackage Tests
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class HomepageControllerTest extends WebTestCase
{
    /**
     * Test de la fonction Index 
     * 
     * @return void 
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
