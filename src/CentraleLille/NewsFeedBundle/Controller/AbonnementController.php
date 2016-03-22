<?php
/**
 * AbonnementController.php File Doc
 *
 * Controller permettant la gestion et l'affichage des abonnements d'un utilisateur
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsfeedBundle
 * @subpackage Controller
 * @author     Corbière Charles <charles.corbiere@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CentraleLille\NewsFeedBundle\Entity\Abonnement;

/**
 * AbonnementController Class Doc
 *
 * Controller permettant la gestion et l'affichage des abonnements
 *
 * @category   Controller
 * @package    CentraleLille:NewsfeedBundle
 * @subpackage Controller
 * @author     Corbière Charles <charles.corbiere@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class AbonnementController extends Controller
{
    /**
    * IndexAction Function Doc
    *
    * Affichage des abonnements d'un utilisateur
    *
    * @return Twig La vue Twig à display
    */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository("CustomFosUserBundle:User")->findOneBy(array('username'=>'marlec'));

        //Récupération des abonnements
        $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
        $abonnements=$abonnementService->getAboAll($user);

        //Récupération des projets récents pour les suggestions
        $recentProjectService=$this->container->get('fablab_homepage.recentProject');
        $recentProjects=$recentProjectService->getRecentProjects(15);

        return $this->render(
            'CentraleLilleNewsFeedBundle:abonnements.html.twig',
            [
                'abonnements' => $abonnements,
                'recentProjects' => $recentProjects
            ]
        );
    }
}