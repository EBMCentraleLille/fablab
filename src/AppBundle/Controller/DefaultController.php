<?php
/**
 * DefaultController File Doc Comment
 *
 * PHP Version 5.5
 *
 * @category DefaultController
 * @package  AppBundle
 * @author   Display Name <username@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * MyClass Class Doc Comment
 *
 * @category DefaultController
 * @package  AppBundle
 * @author   Display Name <username@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
class DefaultController extends Controller
{
    /**
     * IndexAction
     *
     * Description de la fonction
     *
     * @param Request $request Requette
     *
     * @return     truc Machin
=======
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
>>>>>>> Fix
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render(
            'default/index.html.twig',
            array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            )
        );

        return $this->render(
            'default/index.html.twig',
            array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            )
        );
    }
}
