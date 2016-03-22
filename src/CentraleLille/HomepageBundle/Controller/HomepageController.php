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
    * @return Twig La vue Twig à display
    */
    public function indexAction()
    {
        //Récupération des catégories
        $categoryService=$this->container->get('fablab_newsfeed.categories');
        $thematics=$categoryService->getCategories(8);

        //Récupération des dernières actualités
        $activityService=$this->container->get('fablab_newsfeed.activities');
        $recentActivities=$activityService->getActivities(30);
        
        //Récupération du projet "star"
        $starProjectService=$this->container->get('fablab_homepage.starProject');
        $starProject = $starProjectService -> getStarProjects();

        //Récupération des projets récents
        $recentProjectService=$this->container->get('fablab_homepage.recentProject');
        $recentProjects = $recentProjectService -> getRecentProjects(3);

        return $this->render(
            'CentraleLilleHomepageBundle:index.html.twig',
            [
                'starProject' => $starProject,
                'recentActivities' => $recentActivities,
                'thematics' => $thematics,
                'recentProjects' => $recentProjects,
                'username'=>"Martin"
            ]
        );
    }

    /**
    * CategoryAction Function Doc
    *
    * Cette fonction récupère et affiche les informations de l'activité ciblée
    *
    * @param Object $category Entité catégorie à afficher
    *
    * @return Twig La vue Twig à display
    */
    public function categoryAction($category)
    {
        //Récupération des projets de la catégories en question
        $categoryService = $this->container->get('fablab_newsfeed.categories');
        $projects=$categoryService->getProjectsCategory($category);
        $users=$categoryService->getUsersCategory($category);
        return $this->render(
            'CentraleLilleHomepageBundle:category.html.twig',
            [
                'projects' => $projects,
                'users' => $users,
                'category' => $category,
            ]
        );
    }
}
