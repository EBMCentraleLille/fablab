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
use CentraleLille\NewsFeedBundle\Form\FilterType;


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
        $user = $this->getUser();
        if (!$user) {
            $session = $request->getSession()->getFlashBag()->add(
                'notice',
                "Vous devez être connecté pour accéder votre Fil d'Actualité."
            );
            return $this->redirectToRoute('fos_user_security_login');
        } else {

            //Récupération des abonnements du user
            $abonnementService = $this->container->get('fablab_newsfeed.abonnements');
            $abonnements = $abonnementService->getAboAll($user);
            $abonnementsProjet = $abonnementService->getAboProjet($user);

            //Récupération des dernières actualités
            $activityService = $this->container->get('fablab_newsfeed.activities');
            $recentActivities = $activityService->getActivitiesNewsFeed($abonnements, 10);

            //Récupération des abonnements projets
            $abonnementService = $this->container->get('fablab_newsfeed.abonnements');
            $abonnementsProjet = $abonnementService->getAboProjet($user);

            //Récupération des thématiques pour le filtre
            $categoryService = $this->container->get('fablab_newsfeed.categories');
            $thematics = $categoryService->getCategories();

            $filter = [];
            $form = $this
                ->get('form.factory')
                ->create(new FilterType($thematics), $filter);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();

                foreach($recentActivities as $index => $recentActivity){
                    $isDeleted = false;
                    foreach($data as $key => $datavalue){
                        if(!$isDeleted) {
                            switch ($key) {
                                case 'creation':
                                    if ($recentActivity->getType() != 'Creation') {
                                        unset($recentActivities[$index]);
                                        $isDeleted = true;
                                    }
                                    break;
                                case 'update':
                                    if ($recentActivity->getType() != 'update') {
                                        unset($recentActivities[$index]);
                                        $isDeleted = true;
                                    }
                                    break;
                                case 'dateMin':
                                    if ($recentActivity->getDate() <= $datavalue['dateMin']) {
                                        unset($recentActivities[$index]);
                                        $isDeleted = true;
                                    }
                                    break;
                                case 'dateMax':
                                    if ($recentActivity->getDate() >= $datavalue['dateMax']) {
                                        unset($recentActivities[$index]);
                                        $isDeleted = true;
                                    }
                                break;
                                default:
                                    if (is_numeric($key) /*&& $recentActivity->getProject()->getCategory() !== $thematics*/) {
                                        //unset($recentActivity);
                                        //$isDeleted = true;
                                    }
                            }
                        }
                    }

                }

                return $this->render(
                    'CentraleLilleNewsFeedBundle::newsFeed.html.twig',
                    [
                        'recentActivities' => $recentActivities,
                        'abonnements' => $abonnementsProjet,
                        'thematics' => $thematics,
                        'form' => $form->createView(),
                    ]
                );
            }

            return $this->render(
                'CentraleLilleNewsFeedBundle::newsFeed.html.twig',
                [
                    'recentActivities' => $recentActivities,
                    'abonnements' => $abonnementsProjet,
                    'thematics' => $thematics,
                    'form' => $form->createView(),
                ]
            );
        }
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
        $user = $this->getUser();
        if (!$user) {
            $session=$request->getSession()->getFlashBag()->add(
                'notice',
                "Vous devez être connecté pour accéder votre Fil d'Actualité."
            );
            return $this->redirectToRoute('fos_user_security_login');
        } else {
            //récupération du projet liké/déliké
            $projectName = $request->request->get('projet');
            if (!$projectName) {
                return $this->redirectToRoute('news_feed');
            }
            $em = $this->getDoctrine()->getManager();
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
            //Récupération des thématiques pour le filtre
            $categoryService = $this->container->get('fablab_newsfeed.categories');
            $thematics = $categoryService->getCategories();

            $filter = [];
            $form = $this
                ->get('form.factory')
                ->create(new FilterType($thematics), $filter);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                return $this->redirectToRoute(
                    'centrale_lille_newsfeed'
                );
            }
            
            return $this->container->get('templating')->renderResponse(
                'CentraleLilleNewsFeedBundle::newsFeed.html.twig',
                [
                    'recentActivities' => $recentActivities,
                    'abonnements' => $abonnementsProjet,
                    'form' => $form->createView(),
                    'thematics' => $thematics
                ]
            );
        }
    }
}
