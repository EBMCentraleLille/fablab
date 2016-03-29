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
    * @param Request $request requête http
    *
    * @return Twig La vue Twig à display
    */
    public function indexAction(Request $request)
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
            if ($projectName) {
                $em = $this->getDoctrine()->getManager();
                $projet=$em->getRepository("CustomFosUserBundle:Project")->findOneBy(array('name'=>$projectName));
                
                //Abonnement/désabonnement du user au projet en question
                $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
                if ($abonnementService->isAboProjet($user, $projet)) {
                    $abonnementService->removeAboProjet($user, $projet);
                } else {
                    $abonnementService->addAboProjet($user, $projet);
                }
            }

            //récupération de la catégorie likée/délikée
            $categoryName = $request->request->get('category');
            if ($categoryName) {
                $em = $this->getDoctrine()->getManager();
                $category=$em->getRepository(
                    "CentraleLilleNewsFeedBundle:"
                    ."Category"
                )
                    ->findOneBy(array('name'=>$categoryName));
                
                //Abonnement/désabonnement du user au projet en question
                $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
                if ($abonnementService->isAboCategory($user, $category)) {

                    $abonnementService->removeAboCategory($user, $category);
                } else {
                    
                    $abonnementService->addAboCategory($user, $category);
                }
            }
            //Récupération des abonnements projet
            $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
            $abonnementsProjet=$abonnementService->getAboProjet($user);
            $abonnementsCategorie=$abonnementService->getAboCategory($user);

            //Récupération des projets récents pour les suggestions
            $recentProjectService=$this->container->get('fablab_homepage.recentProject');
            $recentProjects=$recentProjectService->getRecentProjects(15);

            return $this->render(
                'CentraleLilleNewsFeedBundle:Default:abonnements.html.twig',
                [
                    'abonnementsProjet' => $abonnementsProjet,
                    'abonnementsCategorie' => $abonnementsCategorie,
                    'recentProjects' => $recentProjects
                ]
            );
        }
    }
}
