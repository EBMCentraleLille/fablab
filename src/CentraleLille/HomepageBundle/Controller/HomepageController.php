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
use CentraleLille\NewsFeedBundle\Entity\Activity;
use CentraleLille\HomepageBundle\Entity\StarProject;
use CentraleLille\CustomFosUserBundle\Entity\Project;

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
        $recentProjects=[
            [
                'userName'=>'Martin Lechaptois',
                'projectName'=>'Project De Martin',
                'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com'
                . '/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
                'likes'=>19,
                'messages'=>3,
                'files'=>4
            ],
            [
                'userName'=>'Martin Lechaptois',
                'projectName'=>'Project De Martin',
                'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com'
                . '/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
                'likes'=>3,
                'messages'=>15,
                'files'=>2
            ],
            [
                'userName'=>'Martin Lechaptois',
                'projectName'=>'Project De Martin',
                'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com'
                . '/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
                'likes'=>5,
                'messages'=>9,
                'files'=>1
            ]];
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

    public function categoryAction($category)
    {
        $categoryService = $this->container->get('fablab_newsfeed.categories');
        $projects=$categoryService->getProjectsCategory($category);
        return $this->render(
            'CentraleLilleHomepageBundle:category.html.twig',
            [
                'projects' => $projects,
            ]
        );
    }
}
