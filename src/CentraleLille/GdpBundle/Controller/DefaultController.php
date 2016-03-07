<?php
/**
 * DefaultController File Doc Comment
 *
 * PHP Version 5.5
 *
 * @category DefaultController
 * @package  DefaultController
 * @author   Display Name <ml.94230@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\GdpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * DefaultControllerClass Doc Comment
 *
 * @category DefaultController
 * @package  DefaultController
 * @author   Display Name <ml.94230@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
class DefaultController extends Controller
{
    /**
     * Index Action
     *
     * Description function
     *
     * @return something
     */
    public function indexAction()
    {
        return $this->render('CentraleLilleGdpBundle:Default:index.html.twig');
    }
}
