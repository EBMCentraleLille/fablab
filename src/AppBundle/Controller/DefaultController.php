<?php
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
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
=======
>>>>>>> Fix

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
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
     * @return truc Machin
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
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
        return $this->render(
            'default/index.html.twig',
            array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            )
        );
=======
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
>>>>>>> Fix
    }
}
