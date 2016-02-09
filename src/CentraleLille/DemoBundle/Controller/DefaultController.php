<?php
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
/**
 * Recipe class file
 *
 * PHP Version 5.5
 *
 * @category DefaultController
 * @package  DefaultController
 * @author   Mathieu Lemoine <ml.94230@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
=======
>>>>>>> Fix

namespace CentraleLille\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
/**
 * DefaultController
 *
 * The class holding the root Recipe class definition
 *
 * @category DefaultController
 * @package  DefaultController
 * @author   Mathieu Lemoine <ml.94230@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
class DefaultController extends Controller
{
    /**
     * IndexAction
     *
     * This function calls a static fetching method against the Ingredient class
     * and returns everything matching this recipe ID
     *
     * @return something
     */
=======
class DefaultController extends Controller
{
>>>>>>> Fix
    public function indexAction()
    {
        return $this->render('CentraleLilleDemoBundle:Default:index.html.twig');
    }
}
