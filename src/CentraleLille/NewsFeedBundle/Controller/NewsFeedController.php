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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    * @return Twig 
    */
    public function indexAction()
    {
        $recentProjects=[
            [
                'userName'=>'Martin Lechaptois',
                'projectName'=>'Project De Martin',
                'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
                'likes'=>19,
                'messages'=>3,
                'files'=>4,
                'date'=>"25/10/2011"
            ],
            [
                'userName'=>'Martin Lechaptois',
                'projectName'=>'Project De Martin',
                'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
                'likes'=>19,
                'messages'=>3,
                'files'=>4,
                'date'=>"25/10/2011"
            ],
            [
                'userName'=>'Martin Lechaptois',
                'projectName'=>'Project De Martin',
                'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
                'likes'=>19,
                'messages'=>3,
                'files'=>4,
                'date'=>"25/10/2011"
            ]];
        $suggestions=[
            [
                'type'=>1,
                'name'=>'Project De Martin'
            ],
            [
                'type'=>2,
                'name'=>'Catégorie Charles'
            ],
            [
                'type'=>1,
                'name'=>'Project De James'
            ],
            [
                'type'=>2,
                'name'=>'Catégorie Roger'
            ],
            [
                'type'=>1,
                'name'=>'Project De Martin'
            ]
            ];             
            $em=$this->getDoctrine()->getManager();
            $user=$em->getRepository('CentraleLilleCustomFosUserBundle:User')->findOneBy(array('name'=>'Martin'));
            $projet=$em->getRepository('CentraleLilleDemoBundle:Projet')->findOneBy(array('name'=>'projet2'));
            $category=$em->getRepository('CentraleLilleNewsFeedBundle:Category')->findOneBy(array('name'=>'category1'));

            $abonnementService = $this->container->get('fablab_newsfeed.abonnements');
            //$abonnementService->addAboProjet($user,$projet);
            //$abonnementService->addAboCategory($user,$category);
            //$projets=$abonnementService->getAboProjet($user); 
            //$categories=$abonnementService->getAboCategory($user); 
            //$projets=$abonnementService->getAboAll($user); 
            //$abonnementService->removeAboProjet($user,$projet);
            //$abonnementService->removeAboCategory($user,$category);
            //var_dump($projets);die;

        return $this->render(
            'CentraleLilleNewsFeedBundle::newsFeed.html.twig', [
                'recentProjects' => $recentProjects,
                'suggestions' => $suggestions
            ]
        );
    }
}
