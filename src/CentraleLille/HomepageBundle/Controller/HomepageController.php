<?php
/**
 * HomePageController.php File Doc
 *
 * Controller permettant le chargement du fil d'actualité d'un user
 * sur la route /news-feed
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:HomepageBundle
 * @subpackage Controller
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\HomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * HomepageController Class Doc
 *
 * Controller de chargement de la homepage
 *
 * @category   Controller
 * @package    CentraleLille:HomepageBundle
 * @subpackage Controller
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class HomepageController extends Controller
{
    /**
    * IndexAction Function Doc
    *
    * Cette fonction récupère les informations des projets récents
    * pour les afficher sur la homepage.
    *
    * @param Request $request Http
    *
    * @return Twig La vue Twig à display
    */
    public function indexAction(Request $request)
    {
        $likes=[];
        //Récupération des catégories
        $categoryService=$this->container->get('fablab_newsfeed.categories');
        $categories=$categoryService->getCategories(8);

        //Récupération des dernières actualités
        $activityService=$this->container->get('fablab_newsfeed.activities');
        $recentActivities=$activityService->getActivities(30);
        
        //Récupération du projet "star"
        $starProjectService=$this->container->get('fablab_homepage.starProject');
        $starProject = $starProjectService -> getStarProjects();

        //Récupération des projets récents
        $recentProjectService=$this->container->get('fablab_homepage.recentProject');
        $recentProjects = $recentProjectService -> getRecentProjects(6);

        $user = $this->getUser();

        if (!$user) {
            foreach ($recentProjects as $recentProject) {
                $likes = array_merge($likes, array($recentProject->getName() => 0));
            }
        } else {
            //récupération du projet liké/déliké
            $projectName = $request->request->get('projet');
            if ($projectName) {
                $em = $this->getDoctrine()->getManager();
                $projet=$em->getRepository("CustomFosUserBundle:Project")->findOneBy(array('name'=>$projectName));
                
                //Abonnement/désabonnement du user au projet en question
                $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
                if ($abonnementService->isAboProjet($user, $projet)) {
                    $recentActivities=$abonnementService->removeAboProjet($user, $projet);
                } else {
                    $recentActivities=$abonnementService->addAboProjet($user, $projet);
                }
            }

            //Récupération des abonnements du user
            $abonnementService = $this->container->get('fablab_newsfeed.abonnements');
            $abonnementsProjets = $abonnementService->getAboProjet($user);
            $abo=[];
            foreach ($abonnementsProjets as $abonnementsProjet) {
                array_push($abo, $abonnementsProjet);
            }
            foreach ($recentProjects as $recentProject) {
                if (in_array($recentProject, $abo)) {
                    $aboProjet = array($recentProject->getName() => 1);
                    $likes = array_merge($likes, $aboProjet);
                } else {
                    $aboProjet = array($recentProject->getName() => 0);
                    $likes = array_merge($likes, $aboProjet);
                }
            }
        }

        return $this->render(
            'CentraleLilleHomepageBundle:Default:index.html.twig',
            [
                'starProject'      => $starProject,
                'recentActivities' => $recentActivities,
                'categories'       => $categories,
                'recentProjects'   => $recentProjects,
                'likes'            =>$likes
            ]
        );
    }

    /**
    * CategoryAction Function Doc
    *
    * Cette fonction récupère et affiche les informations de l'activité ciblée
    *
    * @param Request $request  Http
    * @param Object  $category Entité catégorie à afficher
    *
    * @return Twig La vue Twig à display
    */
    public function categoryAction(Request $request, $category)
    {
        $likes = [];
        //Récupération des projets de la catégories en question
        $categoryService = $this->container->get('fablab_newsfeed.categories');
        $projects = $categoryService->getProjectsCategory($category);
        $users = $categoryService->getUsersCategory($category);

        $user = $this->getUser();
        if (!$user) {
            $isAbo = 0;
            foreach ($projects as $project) {
                $likes = array_merge($likes, array($project->getName() => 0));
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $cat=$em->getRepository(
                "CentraleLilleNewsFeedBundle:"
                ."Category"
            )
                ->findOneBy(array('name'=>$category));

            //Le user est-il abonné à cette catégorie?
            $abonnementService = $this->container->get('fablab_newsfeed.abonnements');
            $isAbo = $abonnementService->isAboCategory($user, $cat);

            //récupération de la catégorie likée/délikée
            $categoryGet = $request->request->get('category');
            if ($categoryGet) {
                //Abonnement/désabonnement du user au projet en question
                $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
                if ($isAbo) {
                    $abonnementService->removeAboCategory($user, $cat);
                } else {
                    $abonnementService->addAboCategory($user, $cat);
                }
            }
            //récupération du projet liké/déliké
            $projectName = $request->request->get('projet');
            if ($projectName) {
                $em = $this->getDoctrine()->getManager();
                $projet=$em->getRepository("CustomFosUserBundle:Project")->findOneBy(array('name'=>$projectName));
                
                //Abonnement/désabonnement du user au projet en question
                $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
                if ($abonnementService->isAboProjet($user, $projet)) {
                    $recentActivities=$abonnementService->removeAboProjet($user, $projet);
                } else {
                    $recentActivities=$abonnementService->addAboProjet($user, $projet);
                }
            }
            //Récupération des abonnements du user
            $abonnementService = $this->container->get('fablab_newsfeed.abonnements');
            $abonnementsProjets = $abonnementService->getAboProjet($user);
            $abo = [];
            foreach ($abonnementsProjets as $abonnementsProjet) {
                array_push($abo, $abonnementsProjet);
            }
            foreach ($projects as $project) {
                if (in_array($project, $abo)) {
                    $aboProjet = array($project->getName() => 1);
                    $likes = array_merge($likes, $aboProjet);
                } else {
                    $aboProjet = array($project->getName() => 0);
                    $likes = array_merge($likes, $aboProjet);
                }
            }
        }

        return $this->render(
            'CentraleLilleHomepageBundle:Default:category.html.twig',
            [
                'projects' => $projects,
                'users'    => $users,
                'category' => $category,
                'isAbo'    => $isAbo,
                'likes'    =>$likes
            ]
        );
    }
}
