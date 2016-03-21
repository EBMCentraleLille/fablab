<?php
/**
 * NewsFeedController.php File Doc
 *
 * Controller permettant le chargement du fil d'actualité d'un user
 * sur la route /news-feed
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Controller
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CentraleLille\CustomFosUserBundle\Entity\User;
use CentraleLille\CustomFosUserBundle\Entity\Project;

/**
 * NewsFeedController Class Doc
 *
 * Controller de chargement du newsfeed
 *
 * @category   Controller
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Controller
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class NewsFeedController extends Controller
{
    /**
    * IndexAction Function Doc
    *
    * Fonction qui charge les premières actualités d'un utilisateurs en fonction de ses abonnements
    *
    * @param Request $request Requête http
    *
    * @return Twig
    */
    public function indexAction(Request $request)
    {
        //$request = $this->container->get('request');
        $em = $this->getDoctrine()->getManager();
        
        $user=$em->getRepository("CustomFosUserBundle:User")->findOneBy(array('username'=>'marlec'));

        //Récupération des dernières actualités
        $activityService=$this->container->get('fablab_newsfeed.activities');
        $recentActivities=$activityService->getActivities(10);

        //Récupération des abonnements projets
        $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
        $abonnementsProjet=$abonnementService->getAboProjet($user);

        return $this->render(
            'CentraleLilleNewsFeedBundle::newsFeed.html.twig',
            [
                'recentActivities' => $recentActivities,
                'abonnements' => $abonnementsProjet
            ]
        );
    }
    /**
    * SubscribeAction Function Doc
    *
    * Fonction qui abonne l'utilisateur à un projet du newsfeed
    *
    * @param Request $request requête http
    *
    * @return Twig
    */
    public function subscribeAction(Request $request)
    {
        //$request = $this->container->get('request');
        $em = $this->getDoctrine()->getManager();
        
        $user=$em->getRepository("CustomFosUserBundle:User")->findOneBy(array('username'=>'marlec'));
        
        $projectName = $request->request->get('projet');
        $projet=$em->getRepository("CustomFosUserBundle:Project")->findOneBy(array('name'=>$projectName));
        
        //Abonnement/désabonnement du user au projet en question
        $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
        if ($abonnementService->isAboProjet($user, $projet)) {
            $recentActivities=$abonnementService->removeAboProjet($user, $projet);
        } else {
            $recentActivities=$abonnementService->addAboProjet($user, $projet);
        }

        //Récupération des dernières actualités
        $activityService=$this->container->get('fablab_newsfeed.activities');
        $recentActivities=$activityService->getActivities(10);

        //Récupération des abonnements projets
        $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
        $abonnementsProjet=$abonnementService->getAboProjet($user);
        
        return $this->container->get('templating')->renderResponse(
            'CentraleLilleNewsFeedBundle::newsFeed.html.twig',
            [
                'recentActivities' => $recentActivities,
                'abonnements' => $abonnementsProjet
            ]
        );
    }
}
